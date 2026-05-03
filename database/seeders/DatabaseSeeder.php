<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ========================
        // 1. ADMIN
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
        // 2. AUDIT
        // ========================
        User::create([
            'nama_lengkap' => 'Petugas Audit',
            'email' => 'audit@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'audit',
            'is_active' => true,
        ]);

        // ========================
        // 3. KELAS
        // ========================
        $kelas1 = Kelas::create([
            'nama_kelas' => 'X-MIPA',
            'tingkat' => '10',
            'jurusan' => 'MIPA',
            'tahun_ajaran' => '2025/2026'
        ]);

         $kelas2 = Kelas::create([
            'nama_kelas' => 'X-IPS',
            'tingkat' => '10',
            'jurusan' => 'MIPA',
            'tahun_ajaran' => '2025/2026'
        ]);

         $kelas3 = Kelas::create([
            'nama_kelas' => 'XI-MIPA',
            'tingkat' => '11',
            'jurusan' => 'MIPA',
            'tahun_ajaran' => '2025/2026'
        ]);

         $kelas4 = Kelas::create([
            'nama_kelas' => 'XI-IPS',
            'tingkat' => '11',
            'jurusan' => 'MIPA',
            'tahun_ajaran' => '2025/2026'
        ]);

         $kelas5 = Kelas::create([
            'nama_kelas' => 'XII-MIPA',
            'tingkat' => '12',
            'jurusan' => 'MIPA',
            'tahun_ajaran' => '2025/2026'
        ]);

         $kelas6 = Kelas::create([
            'nama_kelas' => 'XII-IPS',
            'tingkat' => '12',
            'jurusan' => 'MIPA',
            'tahun_ajaran' => '2025/2026'
        ]);

        // ========================
        // 4. GURU Dan USERNYA
        // ========================
        $guru1 = Guru::create([
            'nip' => '123456789',
            'nama_lengkap' => 'Bapak Budi, S.Pd',
            'jenis_kelamin' => 'L'
        ]);

        User::create([
            'nama_lengkap' => $guru1->nama_lengkap,
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'id_guru' => $guru1->id_guru, // 🔥 relasi
            'is_active' => true,
        ]);

        $guru2 = Guru::create([
            'nip' => '654256876',
            'nama_lengkap' => 'Ibu Sania, S.Pd.',
            'jenis_kelamin' => 'P'
        ]);

        User::create([
            'nama_lengkap' => $guru2->nama_lengkap,
            'email' => 'sania@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'id_guru' => $guru2->id_guru, // 🔥 relasi
            'is_active' => true,
        ]);

        $guru3 = Guru::create([
            'nip' => '234567891',
            'nama_lengkap' => 'Bapak Jarot, S.Pdi.',
            'jenis_kelamin' => 'L'
        ]);

        User::create([
            'nama_lengkap' => $guru3->nama_lengkap,
            'email' => 'jarot@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'id_guru' => $guru3->id_guru, // 🔥 relasi
            'is_active' => true,
        ]);

        $guru4 = Guru::create([
            'nip' => '834869287',
            'nama_lengkap' => 'Bapak Sariman, S.Pd.',
            'jenis_kelamin' => 'L'
        ]);

        User::create([
            'nama_lengkap' => $guru4->nama_lengkap,
            'email' => 'sariman@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'id_guru' => $guru4->id_guru, // 🔥 relasi
            'is_active' => true,
        ]);

        $guru5 = Guru::create([
            'nip' => '087321890',
            'nama_lengkap' => 'Ibu Ambar, S.Pd',
            'jenis_kelamin' => 'P'
        ]);

        User::create([
            'nama_lengkap' => $guru5->nama_lengkap,
            'email' => 'ambar@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'id_guru' => $guru5->id_guru, // 🔥 relasi
            'is_active' => true,
        ]);

        $guru6 = Guru::create([
            'nip' => '738290092',
            'nama_lengkap' => 'Bapak Bayu, S.Pd.',
            'jenis_kelamin' => 'L'
        ]);

        User::create([
            'nama_lengkap' => $guru6->nama_lengkap,
            'email' => 'bayu@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'id_guru' => $guru6->id_guru, // 🔥 relasi
            'is_active' => true,
        ]);

        $guru7 = Guru::create([
            'nip' => '387129029',
            'nama_lengkap' => 'Ibu Safa, S.Pd.',
            'jenis_kelamin' => 'P'
        ]);

        User::create([
            'nama_lengkap' => $guru7->nama_lengkap,
            'email' => 'safa@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'id_guru' => $guru7->id_guru, // 🔥 relasi
            'is_active' => true,
        ]);

        $guru8 = Guru::create([
            'nip' => '213870291',
            'nama_lengkap' => 'Bapak Bagus, S.Pd.',
            'jenis_kelamin' => 'L'
        ]);

        User::create([
            'nama_lengkap' => $guru8->nama_lengkap,
            'email' => 'bagus@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'id_guru' => $guru8->id_guru, // 🔥 relasi
            'is_active' => true,
        ]);

        $guru9 = Guru::create([
            'nip' => '128798728',
            'nama_lengkap' => 'Bapak Sadiman, S.Pd.',
            'jenis_kelamin' => 'L'
        ]);

        User::create([
            'nama_lengkap' => $guru9->nama_lengkap,
            'email' => 'sadiman@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'id_guru' => $guru9->id_guru, // 🔥 relasi
            'is_active' => true,
        ]);

        $guru10 = Guru::create([
            'nip' => '217899287',
            'nama_lengkap' => 'Ibu Danik, S.Pd.',
            'jenis_kelamin' => 'P'
        ]);

        User::create([
            'nama_lengkap' => $guru10->nama_lengkap,
            'email' => 'danik@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'id_guru' => $guru10->id_guru, // 🔥 relasi
            'is_active' => true,
        ]);



        // ========================
        // 5. SISWA dan User
        // ========================
        // Siswa 1
         $siswa1 = Siswa::create([
            'nis' => '2025001',
            'nama_lengkap' => 'Jarwo',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa1->nama_lengkap,
            'email' => 'jarwo@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa1->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 2
        $siswa2 = Siswa::create([
            'nis' => '2025002',
            'nama_lengkap' => 'Ahmad',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa2->nama_lengkap,
            'email' => 'ahmad@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa2->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 3
        $siswa3 = Siswa::create([
            'nis' => '2025003',
            'nama_lengkap' => 'Garnis',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa3->nama_lengkap,
            'email' => 'garnis@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa3->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 4
        $siswa4 = Siswa::create([
            'nis' => '2025004',
            'nama_lengkap' => 'Doni',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa4->nama_lengkap,
            'email' => 'doni@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa4->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 5
        $siswa5 = Siswa::create([
            'nis' => '2025005',
            'nama_lengkap' => 'Sofa',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa5->nama_lengkap,
            'email' => 'sofa@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa5->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 6
        $siswa6 = Siswa::create([
            'nis' => '2025006',
            'nama_lengkap' => 'Samala',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa6->nama_lengkap,
            'email' => 'samala@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa6->id_siswa,
            'is_active' => true,
        ]);



        // ========================
        // 6. MATA PELAJARAN
        // ========================
        MataPelajaran::create([
            'kode_mapel' => 'MP001',
            'nama_mapel' => 'Matematika',
            'jurusan' => 'MIPA',
            'id_guru' => $guru1->id_guru,
        ]);

        MataPelajaran::create([
            'kode_mapel' => 'MP002',
            'nama_mapel' => 'Biologi',
            'jurusan' => 'MIPA',
            'id_guru' => $guru2->id_guru,
        ]);

        MataPelajaran::create([
            'kode_mapel' => 'MP003',
            'nama_mapel' => 'Fisika',
            'jurusan' => 'MIPA',
            'id_guru' => $guru3->id_guru,
        ]);

        MataPelajaran::create([
            'kode_mapel' => 'MP004',
            'nama_mapel' => 'Kimia',
            'jurusan' => 'MIPA',
            'id_guru' => $guru4->id_guru,
        ]);

        MataPelajaran::create([
            'kode_mapel' => 'MP005',
            'nama_mapel' => 'Bahasa Indonesia',
            'jurusan' => 'UMUM',
            'id_guru' => $guru5->id_guru,
        ]);

        MataPelajaran::create([
            'kode_mapel' => 'MP006',
            'nama_mapel' => 'PANCASILA',
            'jurusan' => 'UMUM',
            'id_guru' => $guru6->id_guru,
        ]);

        MataPelajaran::create([
            'kode_mapel' => 'MP007',
            'nama_mapel' => 'Geografi',
            'jurusan' => 'IPS',
            'id_guru' => $guru7->id_guru,
        ]);

        MataPelajaran::create([
            'kode_mapel' => 'MP008',
            'nama_mapel' => 'Ekonomi',
            'jurusan' => 'IPS',
            'id_guru' => $guru8->id_guru,
        ]);

        MataPelajaran::create([
            'kode_mapel' => 'MP009',
            'nama_mapel' => 'Sosiologi',
            'jurusan' => 'IPS',
            'id_guru' => $guru9->id_guru,
        ]);

        MataPelajaran::create([
            'kode_mapel' => 'MP010',
            'nama_mapel' => 'Sejarah',
            'jurusan' => 'IPS',
            'id_guru' => $guru10->id_guru,
        ]);

    }
}
