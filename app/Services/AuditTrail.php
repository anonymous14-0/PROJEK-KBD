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
            'ipv4_address' => $request ? self::extractIpv4Address($request) : null,
            'user_agent' => $request?->userAgent(),
        ]);
    }

    public static function extractIpv4Address(Request $request): ?string
    {
        $candidates = [
            $request->server('REMOTE_ADDR'),
            $request->ip(),
            $request->header('CF-Connecting-IP'),
            $request->header('X-Real-IP'),
            $request->header('X-Forwarded-For'),
            $request->header('Forwarded'),
        ];

        foreach ($candidates as $candidate) {
            foreach (self::splitIpCandidates($candidate) as $ipAddress) {
                if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                    return $ipAddress;
                }
            }
        }

        return null;
    }

    /**
     * @return array<int, string>
     */
    private static function splitIpCandidates(mixed $candidate): array
    {
        if (! is_string($candidate) || trim($candidate) === '') {
            return [];
        }

        $candidate = str_replace(['for=', '"', '[', ']'], '', $candidate);
        $parts = preg_split('/[,;\s]+/', $candidate) ?: [];

        return array_values(array_filter(array_map(static function (string $part): string {
            $part = trim($part);

            if (str_contains($part, ':') && substr_count($part, ':') === 1) {
                $part = explode(':', $part, 2)[0];
            }

            return $part;
        }, $parts)));
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

    public static function recordSuccessfulLogin(Request $request): void
    {
        // Keamanan: audit log login berhasil membantu mendeteksi pemakaian akun yang tidak wajar.
        self::record('Login berhasil', $request);
    }

    public static function recordFailedLogin(Request $request): void
    {
        $email = (string) $request->input('email');
        // Keamanan: lookup user memakai Eloquent parameter binding/prepared statement dan email terenkripsi seperti di database.
        $userId = User::where('email', User::encryptData($email))->value('id_user');

        // Keamanan: audit log login gagal membantu mendeteksi brute-force dan credential stuffing.
        self::record("Percobaan login gagal untuk email {$email}", $request, $userId);
    }

    public static function recordLogout(Request $request): void
    {
        // Keamanan: audit log logout mencatat akhir sesi pengguna untuk rekonsiliasi aktivitas.
        self::record('Logout', $request);
    }

    public static function recordSessionExpired(Request $request, string $reason): void
    {
        // Keamanan: audit log session expired/User-Agent berubah memberi jejak forensik indikasi hijacking.
        self::record($reason, $request);
    }
}
