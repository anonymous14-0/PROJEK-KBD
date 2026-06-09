<?php

namespace Tests\Unit;

use App\Services\AuditTrail;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class AuditTrailTest extends TestCase
{
    public function test_extract_ipv4_address_from_direct_request_ip(): void
    {
        $request = Request::create('/login', 'POST', server: [
            'REMOTE_ADDR' => '192.0.2.10',
        ]);

        $this->assertSame('192.0.2.10', AuditTrail::extractIpv4Address($request));
    }

    public function test_extract_ipv4_address_from_forwarded_header_when_request_ip_is_ipv6(): void
    {
        $request = Request::create('/login', 'POST', server: [
            'REMOTE_ADDR' => '2001:db8::1234',
            'HTTP_X_FORWARDED_FOR' => '198.51.100.24, 2001:db8::1234',
        ]);

        $this->assertSame('198.51.100.24', AuditTrail::extractIpv4Address($request));
    }

    public function test_describe_changes_lists_before_and_after_values(): void
    {
        $description = AuditTrail::describeChanges(
            [
                'nama_lengkap' => 'Budi Lama',
                'jenis_kelamin' => 'L',
                'email' => 'budi-lama@siakad.com',
            ],
            [
                'nama_lengkap' => 'Budi Baru',
                'jenis_kelamin' => 'L',
                'email' => 'budi-baru@siakad.com',
            ],
            [
                'nama_lengkap' => 'Nama lengkap',
                'jenis_kelamin' => 'Jenis kelamin',
                'email' => 'Email akun',
            ]
        );

        $this->assertSame(
            'Detail perubahan: Nama lengkap: sebelum "Budi Lama", sesudah "Budi Baru"; Email akun: sebelum "budi-lama@siakad.com", sesudah "budi-baru@siakad.com".',
            $description
        );
    }

    public function test_describe_changes_explains_when_no_data_changed(): void
    {
        $description = AuditTrail::describeChanges(
            ['nama_lengkap' => 'Budi'],
            ['nama_lengkap' => 'Budi'],
            ['nama_lengkap' => 'Nama lengkap']
        );

        $this->assertSame('Detail perubahan: tidak ada data yang berubah.', $description);
    }
}
