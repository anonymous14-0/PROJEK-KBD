<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        // Keamanan: halaman berotorisasi wajib memiliki user terautentikasi.
        if (! $user) {
            return redirect()->route('login');
        }

        // Keamanan: akun nonaktif dipaksa logout agar session lama tidak tetap berwenang.
        if (! $user->is_active) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            abort(403, 'Akun Anda tidak aktif. Silakan hubungi administrator.');
        }

        // Keamanan: validasi role/authorization di setiap grup halaman yang memerlukan login.
        if ($roles !== [] && ! in_array($user->role, $roles, true)) {
            abort(403, 'Akses ditolak. Role Anda tidak berhak membuka halaman ini.');
        }

        return $next($request);
    }
}
