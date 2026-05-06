<?php

namespace App\Services;

use App\Models\AktivitasLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditTrail
{
    public static function record(string $aktivitas, ?Request $request = null): void
    {
        $userId = Auth::id();

        if (! $userId) {
            return;
        }

        AktivitasLog::create([
            'id_user' => $userId,
            'aktivitas' => $aktivitas,
            'ip_address' => $request?->ip(),
            'user_agent' => $request?->userAgent(),
        ]);
    }
}
