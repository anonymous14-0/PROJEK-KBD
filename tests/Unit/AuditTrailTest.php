<?php

namespace Tests\Unit;

use App\Services\AuditTrail;
use PHPUnit\Framework\TestCase;

class AuditTrailTest extends TestCase
{
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
