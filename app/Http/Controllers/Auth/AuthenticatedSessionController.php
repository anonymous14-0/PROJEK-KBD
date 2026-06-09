<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\AuditTrail;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        session([
            'captcha_num1' => rand(1, 10),
            'captcha_num2' => rand(1, 10),
        ]);

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Validasi CAPTCHA
        if ((int)$request->captcha !==
            (session('captcha_num1') + session('captcha_num2'))) {
            // Keamanan: audit log login gagal juga dicatat ketika CAPTCHA salah.
            AuditTrail::recordFailedLogin($request);

            return back()->withErrors([
                'captcha' => 'Jawaban captcha salah.'
            ])->withInput();
        }

        // Keamanan: proses login memakai LoginRequest yang memanfaatkan guard Laravel/Eloquent dengan prepared statement, bukan raw SQL.
        $request->authenticate();

        // Keamanan: regenerasi Session ID setelah login untuk mencegah session fixation/hijacking.
        $request->session()->regenerate();

        // Keamanan: simpan fingerprint User-Agent untuk mendeteksi perubahan client yang mengindikasikan session hijacking.
        $request->session()->put('security.user_agent_hash', hash('sha256', (string) $request->userAgent()));
        // Keamanan: simpan alamat IP login sebagai binding tambahan agar session curian dari IP berbeda dapat dihentikan.
        $request->session()->put('security.ip_address', $request->ip());
        // Keamanan: simpan waktu aktivitas awal untuk validasi idle timeout 30 menit pada request berikutnya.
        $request->session()->put('security.last_activity_at', now()->timestamp);

        // Keamanan: audit log login berhasil untuk investigasi insiden autentikasi.
        // Keamanan: audit log login berhasil untuk investigasi insiden autentikasi.
        AuditTrail::recordSuccessfulLogin($request);

        $user = $request->user();

        if ($user->must_change_password) {
            return redirect()->route('profile.edit');
        }
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Keamanan: audit log logout sebelum data sesi dihapus agar peristiwa tetap tercatat.
        AuditTrail::recordLogout($request);

        Auth::guard('web')->logout();

        // Keamanan: hapus seluruh data session PHP/Laravel saat logout untuk mencegah reuse session curian.
        $request->session()->flush();
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
        }

        // Keamanan: invalidate session dan regenerasi CSRF token setelah logout.
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
