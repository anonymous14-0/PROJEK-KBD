<?php

namespace App\Services;

use App\Models\AktivitasLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditTrail
{
    public static function record(string $aktivitas, ?Request $request = null, ?int $userId = null): void
    {
        $userId ??= Auth::id();

        AktivitasLog::create([
            'id_user' => $userId,
            'aktivitas' => $aktivitas,
            'ip_address' => $request?->ip(),
            'user_agent' => $request?->userAgent(),
        ]);
    }

    public static function recordFailedLogin(Request $request): void
    {
        $email = (string) $request->input('email');
        $userId = User::where('email', $email)->value('id_user');

        self::record("Percobaan login gagal untuk email {$email}", $request, $userId);
    }
}
