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
    public function handle(Request $request, Closure $next, $role): Response
    {
        // 1. Cek apakah user sudah login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // 2. Cek apakah role user di database sama dengan role yang diminta di Route
        // Misal: di Route minta 'admin', tapi user loginnya 'siswa', maka ditolak.
        if (auth()->user()->role !== $role) {
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak!');
        }

        return $next($request);
    }
}