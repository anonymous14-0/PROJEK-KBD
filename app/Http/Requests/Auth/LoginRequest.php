<?php

namespace App\Http\Requests\Auth;

use App\Models\User; // Tambahan untuk memanggil fungsi enkripsi
use App\Services\AuditTrail;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public const MAX_LOGIN_ATTEMPTS = 5;
    public const LOCKOUT_SECONDS = 300;
    public const INVALID_LOGIN_MESSAGE = 'Email/username atau password salah.';
    public const LOCKOUT_MESSAGE = 'Percobaan login sudah habis. Login diblokir sementara selama 5 menit.';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // 1. Enkripsi input email yang diketik user sebelum dicocokkan ke database
        $encryptedEmail = User::encryptData($this->input('email'));

        // 2. Gunakan email yang sudah terenkripsi di dalam credentials
        $credentials = [
            'email' => $encryptedEmail,
            'password' => $this->input('password'),
            'is_active' => true, // Fitur bawaan Anda tetap dipertahankan
        ];

        if (! Auth::attempt($credentials, $this->boolean('remember'))) {
            // Tambah percobaan gagal dan simpan status blokir selama 5 menit.
            RateLimiter::hit($this->throttleKey(), self::LOCKOUT_SECONDS);

            if (RateLimiter::tooManyAttempts($this->throttleKey(), self::MAX_LOGIN_ATTEMPTS)) {
                $this->startLockoutPeriod();
            }

            AuditTrail::recordFailedLogin($this);

            Log::warning('Percobaan login gagal', [
                'email' => $this->input('email'), // Tetap log plaintext agar mudah dibaca di log
                'ip_address' => $this->ip(),
                'user_agent' => $this->userAgent(),
                'sisa_percobaan' => $this->remainingAttempts(),
            ]);

            throw ValidationException::withMessages([
                'email' => $this->loginFailureMessage(),
            ]);
        }

        // Reset percobaan jika login berhasil
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        // Maksimal 5 percobaan login gagal dalam periode blokir 5 menit.
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), self::MAX_LOGIN_ATTEMPTS)) {
            return;
        }

        event(new Lockout($this));

        Log::warning('Rate limit login terpicu', [
            'email' => $this->input('email'), // Tetap menggunakan plaintext untuk log
            'ip_address' => $this->ip(),
            'blokir_detik' => RateLimiter::availableIn($this->throttleKey()),
        ]);

        throw ValidationException::withMessages([
            'email' => $this->lockoutMessage(),
        ]);
    }

    public function remainingAttempts(): int
    {
        return max(0, RateLimiter::remaining($this->throttleKey(), self::MAX_LOGIN_ATTEMPTS));
    }

    private function loginFailureMessage(): string
    {
        if (RateLimiter::tooManyAttempts($this->throttleKey(), self::MAX_LOGIN_ATTEMPTS)) {
            return $this->lockoutMessage();
        }

        return self::INVALID_LOGIN_MESSAGE.' Sisa percobaan login: '.$this->remainingAttempts().' dari '.self::MAX_LOGIN_ATTEMPTS.'.';
    }

    private function lockoutMessage(): string
    {
        $seconds = RateLimiter::availableIn($this->throttleKey());
        $minutes = max(1, (int) ceil($seconds / 60));

        return self::LOCKOUT_MESSAGE.' Silakan coba lagi dalam '.$minutes.' menit.';
    }

    private function startLockoutPeriod(): void
    {
        RateLimiter::clear($this->throttleKey());

        for ($attempt = 1; $attempt <= self::MAX_LOGIN_ATTEMPTS; $attempt++) {
            RateLimiter::hit($this->throttleKey(), self::LOCKOUT_SECONDS);
        }
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(
            Str::lower($this->string('email')) . '|' . $this->ip()
        );
    }
}
