<?php

namespace App\Http\Requests\Auth;

use App\Models\User; // Tambahan untuk memanggil fungsi enkripsi
use App\Services\AuditTrail;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public const SPAM_WARNING_MESSAGE = 'mau ngapain spam cuki';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
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

            // Tambah percobaan gagal + lock 60 detik
            RateLimiter::hit($this->throttleKey(), 60);

            AuditTrail::recordFailedLogin($this);

            Log::warning('Percobaan login gagal', [
                'email' => $this->input('email'), // Tetap log plaintext agar mudah dibaca di log
                'ip_address' => $this->ip(),
                'user_agent' => $this->userAgent(),
            ]);

            throw ValidationException::withMessages([
                'email' => self::SPAM_WARNING_MESSAGE,
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
        // Maksimal 5 percobaan login gagal
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        Log::warning('Rate limit login terpicu', [
            'email' => $this->input('email'), // Tetap menggunakan plaintext untuk log
            'ip_address' => $this->ip(),
        ]);

        throw ValidationException::withMessages([
            'email' => self::SPAM_WARNING_MESSAGE,
        ]);
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
