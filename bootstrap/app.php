<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            // Keamanan: validasi timeout sesi dan fingerprint User-Agent pada seluruh request web.
            \App\Http\Middleware\ValidateSessionSecurity::class,
            \App\Http\Middleware\EnsurePasswordHasBeenChanged::class,
        ]);

        // Memberitahu Laravel bahwa 'role' merujuk ke file RoleManager kita
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleManager::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();