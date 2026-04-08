<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kelas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat data Kelas contoh
        Kelas::create([
            'nama_kelas' => 'X-PPLG-1',
            'tingkat' => '10',
            'jurusan' => 'PPLG',
            'tahun_ajaran' => '2025/2026'
        ]);

        // 2. Akun ADMIN
        User::create([
            'nama_lengkap' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // 3. Akun GURU
        User::create([
            'nama_lengkap' => 'Bapak Guru Budi',
            'email' => 'guru@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'is_active' => true,
        ]);

        // 4. Akun SISWA
        User::create([
            'nama_lengkap' => 'Siswa Pintar',
            'email' => 'siswa@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'is_active' => true,
        ]);

        // 5. Akun AUDIT
        User::create([
            'nama_lengkap' => 'Petugas Audit',
            'email' => 'audit@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'audit',
            'is_active' => true,
        ]);
    }
}