<?php

namespace App\Http\Middleware;

// Closure mewakili proses berikutnya dalam rantai middleware Laravel.
use Closure;
// Request berisi data permintaan HTTP dan user yang sedang login.
use Illuminate\Http\Request;
// Response adalah tipe data balasan HTTP yang dikembalikan middleware.
use Symfony\Component\HttpFoundation\Response;

// Middleware ini memeriksa status login, status aktif akun, dan role pengguna.
class CheckRole
{
    /**
     * Memproses request yang masuk dan memastikan user memiliki role yang diizinkan.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Mengambil user yang sedang login dari request.
        $user = $request->user();

        // Jika belum login, pengguna diarahkan ke halaman login.
        if (! $user) {
            return redirect()->route('login');
        }

        // Jika akun tidak aktif, akses dihentikan dengan kode 403.
        if (! $user->is_active) {
            abort(403, 'Akun Anda tidak aktif.');
        }

        // Jika route menentukan role tertentu dan role user tidak sesuai, akses ditolak.
        if ($roles !== [] && ! in_array($user->role, $roles, true)) {
            abort(403, 'Akses ditolak.');
        }

        // Jika semua pengecekan lolos, request dilanjutkan ke controller atau route berikutnya.
        return $next($request);
    }
}
