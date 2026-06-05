<?php

namespace App\Services;

use App\Models\AktivitasLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

    /**
     * Membuat deskripsi perubahan yang mudah dibaca untuk log audit.
     *
     * @param  array<string, mixed>  $before
     * @param  array<string, mixed>  $after
     * @param  array<string, string>  $labels
     */
    public static function describeChanges(array $before, array $after, array $labels = []): string
    {
        $changes = [];

        foreach ($after as $field => $newValue) {
            $oldValue = $before[$field] ?? null;
            $oldDisplayValue = self::stringifyValue($oldValue);
            $newDisplayValue = self::stringifyValue($newValue);

            if ($oldDisplayValue === $newDisplayValue) {
                continue;
            }

            $label = $labels[$field] ?? Str::headline($field);
            $changes[] = sprintf(
                '%s: sebelum "%s", sesudah "%s"',
                $label,
                $oldDisplayValue,
                $newDisplayValue
            );
        }

        if ($changes === []) {
            return 'Detail perubahan: tidak ada data yang berubah.';
        }

        return 'Detail perubahan: '.implode('; ', $changes).'.';
    }

    private static function stringifyValue(mixed $value): string
    {
        if ($value === null || $value === '') {
            return '-';
        }

        if (is_bool($value)) {
            return $value ? 'Ya' : 'Tidak';
        }

        if (is_array($value)) {
            return json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?: '-';
        }

        return (string) $value;
    }

    public static function recordFailedLogin(Request $request): void
    {
        $email = (string) $request->input('email');
        $userId = User::where('email', $email)->value('id_user');

        self::record("Percobaan login gagal untuk email {$email}", $request, $userId);
    }
}
