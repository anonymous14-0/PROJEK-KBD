<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePasswordHasBeenChanged
{
    /**
     * Redirect users with temporary passwords to the password form until changed.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || ! $user->must_change_password) {
            return $next($request);
        }

        if ($request->routeIs('profile.edit', 'password.update', 'logout')) {
            return $next($request);
        }

        return redirect()
            ->route('profile.edit')
            ->with('warning', 'Silakan ganti password sementara Anda sebelum mengakses fitur lain.');
    }
}
