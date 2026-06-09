<?php

namespace App\Http\Middleware;

use App\Services\AuditTrail;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ValidateSessionSecurity
{
    /**
     * Keamanan: batas idle session 30 menit untuk mengurangi jendela pemakaian session yang dicuri.
     */
    private const IDLE_TIMEOUT_SECONDS = 1800;

    /**
     * Keamanan: validasi sesi login terhadap timeout, fingerprint User-Agent, dan alamat IP pada setiap request web.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return $next($request);
        }

        $now = now()->timestamp;
        $lastActivityAt = (int) $request->session()->get('security.last_activity_at', $now);
        $storedUserAgentHash = $request->session()->get('security.user_agent_hash');
        $currentUserAgentHash = hash('sha256', (string) $request->userAgent());
        $storedIpAddress = $request->session()->get('security.ip_address');
        $currentIpAddress = (string) $request->ip();

        // Keamanan: logout otomatis jika user tidak aktif lebih dari 30 menit.
        if (($now - $lastActivityAt) > self::IDLE_TIMEOUT_SECONDS) {
            return $this->terminateCompromisedSession($request, 'Session expired karena tidak aktif lebih dari 30 menit.');
        }

        // Keamanan: set fingerprint User-Agent jika sesi lama belum memilikinya agar tetap kompatibel setelah deploy.
        if (! is_string($storedUserAgentHash) || $storedUserAgentHash === '') {
            $request->session()->put('security.user_agent_hash', $currentUserAgentHash);
            $storedUserAgentHash = $currentUserAgentHash;
        }

        // Keamanan: logout otomatis jika User-Agent berubah, indikasi potensi session hijacking.
        if (! hash_equals($storedUserAgentHash, $currentUserAgentHash)) {
            return $this->terminateCompromisedSession($request, 'Session dihentikan karena User-Agent berubah.');
        }

        // Keamanan: set alamat IP untuk sesi lama yang belum memilikinya agar validasi tetap kompatibel setelah deploy.
        if (! is_string($storedIpAddress) || $storedIpAddress === '') {
            $request->session()->put('security.ip_address', $currentIpAddress);
            $storedIpAddress = $currentIpAddress;
        }

        // Keamanan: logout otomatis jika alamat IP berubah karena session yang sama dipakai dari jaringan berbeda mengindikasikan session hijacking.
        if (! hash_equals($storedIpAddress, $currentIpAddress)) {
            return $this->terminateCompromisedSession($request, 'Session dihentikan karena alamat IP berubah.');
        }

        // Keamanan: perbarui waktu aktivitas hanya setelah sesi lolos validasi.
        $request->session()->put('security.last_activity_at', $now);

        return $next($request);
    }

    /**
     * Keamanan: hapus semua data session dan catat audit trail saat sesi tidak valid.
     */
    private function terminateCompromisedSession(Request $request, string $reason): RedirectResponse
    {
        AuditTrail::recordSessionExpired($request, $reason);

        Auth::guard('web')->logout();

        $request->session()->flush();
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->withErrors(['email' => $reason]);
    }
}
