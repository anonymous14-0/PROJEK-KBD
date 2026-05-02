<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ========================
        // 1. KELAS
        // ========================
        $kelas = Kelas::create([
            'nama_kelas' => 'X-PPLG-1',
            'tingkat' => '10',
            'jurusan' => 'PPLG',
            'tahun_ajaran' => '2025/2026'
        ]);

        // ========================
        // 2. GURU
        // ========================
        $guru = Guru::create([
            'nip' => '123456789',
            'nama_lengkap' => 'Bapak Guru Budi',
            'jenis_kelamin' => 'L'
        ]);

        // ========================
        // 3. SISWA
        // ========================
        $siswa = Siswa::create([
            'nis' => '2025001',
            'nama_lengkap' => 'Siswa Pintar',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas->id_kelas
        ]);

        // ========================
        // 4. ADMIN
        // ========================
        User::create([
            'nama_lengkap' => 'Bagas Agung Krisnawan',
            'email' => 'bagaskemiren@gmail.com',
            'password' => Hash::make('bagaskemiren@312'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        User::create([
            'nama_lengkap' => 'Dimas Jemi Pratama',
            'email' => 'jemicimanggu@gmail.com',
            'password' => Hash::make('jemicimanggu#321'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        User::create([
            'nama_lengkap' => 'Julian Arya Mukti',
            'email' => 'julianboyolali@gmail.com',
            'password' => Hash::make('julianboyolali%76'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        User::create([
            'nama_lengkap' => 'Mayfrillia Syaira',
            'email' => 'mayfrilliaprobolinggo@gmail.com',
            'password' => Hash::make('mayfrilliaprobolinggo^65'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        User::create([
            'nama_lengkap' => 'Nafis Majid Munthassir',
            'email' => 'nafiskebumen@gmail.com',
            'password' => Hash::make('nafiskebumen*653'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // ========================
        // 5. USER GURU (TERHUBUNG)
        // ========================
        User::create([
            'nama_lengkap' => $guru->nama_lengkap,
            'email' => 'guru@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'id_guru' => $guru->id_guru, // 🔥 relasi
            'is_active' => true,
        ]);

        // ========================
        // 6. USER SISWA (TERHUBUNG)
        // ========================
        User::create([
            'nama_lengkap' => $siswa->nama_lengkap,
            'email' => 'siswa@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa->id_siswa, // 🔥 relasi
            'is_active' => true,
        ]);

        // ========================
        // 7. AUDIT
        // ========================
        User::create([
            'nama_lengkap' => 'Petugas Audit',
            'email' => 'audit@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'audit',
            'is_active' => true,
        ]);
    }
}
