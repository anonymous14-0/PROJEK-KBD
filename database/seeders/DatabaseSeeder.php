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
            'jurusan' => 'MIPS',
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
            'jurusan' => 'MIPS',
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
            'jurusan' => 'MIPS',
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
        // Siswa Kelas 10 MIPA 1
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

         $siswa2 = Siswa::create([
            'nis' => '2025002',
            'nama_lengkap' => 'Joko',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa2->nama_lengkap,
            'email' => 'joko@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa2->id_siswa,
            'is_active' => true,
        ]);

         $siswa3 = Siswa::create([
            'nis' => '2025003',
            'nama_lengkap' => 'Kiki',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa3->nama_lengkap,
            'email' => 'kiki@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa3->id_siswa,
            'is_active' => true,
        ]);

         $siswa4 = Siswa::create([
            'nis' => '2025004',
            'nama_lengkap' => 'Jentod',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa4->nama_lengkap,
            'email' => 'jentod@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa4->id_siswa,
            'is_active' => true,
        ]);

         $siswa5 = Siswa::create([
            'nis' => '2025005',
            'nama_lengkap' => 'Jimbo',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa5->nama_lengkap,
            'email' => 'jimbo@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa5->id_siswa,
            'is_active' => true,
        ]);

         $siswa6 = Siswa::create([
            'nis' => '2025006',
            'nama_lengkap' => 'Surya',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa6->nama_lengkap,
            'email' => 'surya@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa6->id_siswa,
            'is_active' => true,
        ]);

         $siswa7 = Siswa::create([
            'nis' => '2025007',
            'nama_lengkap' => 'Celsi',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas1->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa7->nama_lengkap,
            'email' => 'celsi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa7->id_siswa,
            'is_active' => true,
        ]);

         $siswa8 = Siswa::create([
            'nis' => '2025008',
            'nama_lengkap' => 'Ciwa',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas1->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa8->nama_lengkap,
            'email' => 'ciwa@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa8->id_siswa,
            'is_active' => true,
        ]);

         $siswa9 = Siswa::create([
            'nis' => '2025009',
            'nama_lengkap' => 'Diva',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas1->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa9->nama_lengkap,
            'email' => 'diva@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa9->id_siswa,
            'is_active' => true,
        ]);

         $siswa10 = Siswa::create([
            'nis' => '20250010',
            'nama_lengkap' => 'Dania',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas1->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa10->nama_lengkap,
            'email' => 'Dania@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa10->id_siswa,
            'is_active' => true,
        ]);

         $siswa11 = Siswa::create([
            'nis' => '20250011',
            'nama_lengkap' => 'Agus',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa11->nama_lengkap,
            'email' => 'agus@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa11->id_siswa,
            'is_active' => true,
        ]);

         $siswa12 = Siswa::create([
            'nis' => '20250012',
            'nama_lengkap' => 'Agung',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas1->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa12->nama_lengkap,
            'email' => 'agung@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa12->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 13
        $siswa13 = Siswa::create([
            'nis' => '20250013',
            'nama_lengkap' => 'Andika',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa13->nama_lengkap,
            'email' => 'andika@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa13->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 14
        $siswa14 = Siswa::create([
            'nis' => '20250014',
            'nama_lengkap' => 'Andi',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa14->nama_lengkap,
            'email' => 'andi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa14->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 15
        $siswa15 = Siswa::create([
            'nis' => '20250015',
            'nama_lengkap' => 'Anton',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa15->nama_lengkap,
            'email' => 'anton@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa15->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 16
        $siswa16 = Siswa::create([
            'nis' => '20250016',
            'nama_lengkap' => 'Ari',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa16->nama_lengkap,
            'email' => 'ari@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa16->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 17
        $siswa17 = Siswa::create([
            'nis' => '20250017',
            'nama_lengkap' => 'Aris',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa17->nama_lengkap,
            'email' => 'aris@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa17->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 18
        $siswa18 = Siswa::create([
            'nis' => '20250018',
            'nama_lengkap' => 'Arif',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa18->nama_lengkap,
            'email' => 'arif@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa18->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 19
        $siswa19 = Siswa::create([
            'nis' => '20250019',
            'nama_lengkap' => 'Arya',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa19->nama_lengkap,
            'email' => 'arya@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa19->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 20
        $siswa20 = Siswa::create([
            'nis' => '20250020',
            'nama_lengkap' => 'Bagas',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa20->nama_lengkap,
            'email' => 'bagas@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa20->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 21
        $siswa21 = Siswa::create([
            'nis' => '20250021',
            'nama_lengkap' => 'Bambang',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa21->nama_lengkap,
            'email' => 'bambang@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa21->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 22
        $siswa22 = Siswa::create([
            'nis' => '20250022',
            'nama_lengkap' => 'yusril',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa22->nama_lengkap,
            'email' => 'yusril@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa22->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 23
        $siswa23 = Siswa::create([
            'nis' => '20250023',
            'nama_lengkap' => 'Beni',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa23->nama_lengkap,
            'email' => 'beni@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa23->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 24
        $siswa24 = Siswa::create([
            'nis' => '20250024',
            'nama_lengkap' => 'Bima',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa24->nama_lengkap,
            'email' => 'bima@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa24->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 25
        $siswa25 = Siswa::create([
            'nis' => '20250025',
            'nama_lengkap' => 'Baser',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa25->nama_lengkap,
            'email' => 'baser@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa25->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 26
        $siswa26 = Siswa::create([
            'nis' => '20250026',
            'nama_lengkap' => 'Cahyo',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa26->nama_lengkap,
            'email' => 'cahyo@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa26->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 27
        $siswa27 = Siswa::create([
            'nis' => '20250027',
            'nama_lengkap' => 'Dedi',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa27->nama_lengkap,
            'email' => 'dedi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa27->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 28
        $siswa28 = Siswa::create([
            'nis' => '20250028',
            'nama_lengkap' => 'Dediansyah',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa28->nama_lengkap,
            'email' => 'dediansyah@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa28->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 29
        $siswa29 = Siswa::create([
            'nis' => '20250029',
            'nama_lengkap' => 'Deni',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa29->nama_lengkap,
            'email' => 'deni@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa29->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 30
        $siswa30 = Siswa::create([
            'nis' => '20250030',
            'nama_lengkap' => 'Dimas',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas1->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa30->nama_lengkap,
            'email' => 'dimas@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa30->id_siswa,
            'is_active' => true,
        ]);

        // Siswa Kelas 10 IPS 1
        $siswa31 = Siswa::create([
            'nis' => '20250031',
            'nama_lengkap' => 'Ahmad',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa2->nama_lengkap,
            'email' => 'ahmad@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa11->id_siswa,
            'is_active' => true,
        ]);

        $siswa32 = Siswa::create([
            'nis' => '20250032',
            'nama_lengkap' => 'Garnis',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa32->nama_lengkap,
            'email' => 'garnis@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa32->id_siswa,
            'is_active' => true,
        ]);

        $siswa33 = Siswa::create([
            'nis' => '20250033',
            'nama_lengkap' => 'Doni',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa33->nama_lengkap,
            'email' => 'doni@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa33->id_siswa,
            'is_active' => true,
        ]);

        $siswa34 = Siswa::create([
            'nis' => '20250034',
            'nama_lengkap' => 'Sofa',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa34->nama_lengkap,
            'email' => 'sofa@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa34->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 6
        $siswa35 = Siswa::create([
            'nis' => '20250035',
            'nama_lengkap' => 'Samala',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa35->nama_lengkap,
            'email' => 'samala@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa35->id_siswa,
            'is_active' => true,
        ]);

         $siswa36 = Siswa::create([
            'nis' => '20250036',
            'nama_lengkap' => 'Anita',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas2->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa36->nama_lengkap,
            'email' => 'anita@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa36->id_siswa,
            'is_active' => true,
        ]);

         $siswa37 = Siswa::create([
            'nis' => '20250037',
            'nama_lengkap' => 'Rantu',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas2->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa37->nama_lengkap,
            'email' => 'rantu@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa37->id_siswa,
            'is_active' => true,
        ]);

         $siswa38 = Siswa::create([
            'nis' => '20250038',
            'nama_lengkap' => 'Serli',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas2->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa38->nama_lengkap,
            'email' => 'serli@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa38->id_siswa,
            'is_active' => true,
        ]);

        $siswa39 = Siswa::create([
            'nis' => '20250039',
            'nama_lengkap' => 'Suryanti',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas2->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa39->nama_lengkap,
            'email' => 'suryanti@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa39->id_siswa,
            'is_active' => true,
        ]);

        $siswa40 = Siswa::create([
            'nis' => '20250040',
            'nama_lengkap' => 'Sawo',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa40->nama_lengkap,
            'email' => 'sawo@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa40->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 41
        $siswa41 = Siswa::create([
            'nis' => '20250041',
            'nama_lengkap' => 'Eko',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa41->nama_lengkap,
            'email' => 'eko@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa41->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 42
        $siswa42 = Siswa::create([
            'nis' => '20250042',
            'nama_lengkap' => 'Ekoan',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa42->nama_lengkap,
            'email' => 'ekoan@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa42->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 43
        $siswa43 = Siswa::create([
            'nis' => '20250043',
            'nama_lengkap' => 'Erwin',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa43->nama_lengkap,
            'email' => 'erwin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa43->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 44
        $siswa44 = Siswa::create([
            'nis' => '20250044',
            'nama_lengkap' => 'Fajar',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa44->nama_lengkap,
            'email' => 'fajar@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa44->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 45
        $siswa45 = Siswa::create([
            'nis' => '20250045',
            'nama_lengkap' => 'Fahmi',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa45->nama_lengkap,
            'email' => 'fahmi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa45->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 46
        $siswa46 = Siswa::create([
            'nis' => '20250046',
            'nama_lengkap' => 'Farhan',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa46->nama_lengkap,
            'email' => 'farhan@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa46->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 47
        $siswa47 = Siswa::create([
            'nis' => '20250047',
            'nama_lengkap' => 'Ferdi',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa47->nama_lengkap,
            'email' => 'ferdi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa47->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 48
        $siswa48 = Siswa::create([
            'nis' => '20250048',
            'nama_lengkap' => 'Firmansyah',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa48->nama_lengkap,
            'email' => 'firmansyah@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa48->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 49
        $siswa49 = Siswa::create([
            'nis' => '20250049',
            'nama_lengkap' => 'Fikri',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa49->nama_lengkap,
            'email' => 'fikri@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa49->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 50
        $siswa50 = Siswa::create([
            'nis' => '20250050',
            'nama_lengkap' => 'Galih',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa50->nama_lengkap,
            'email' => 'galih@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa50->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 51
        $siswa51 = Siswa::create([
            'nis' => '20250051',
            'nama_lengkap' => 'Gilang',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa51->nama_lengkap,
            'email' => 'gilang@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa51->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 52
        $siswa52 = Siswa::create([
            'nis' => '20250052',
            'nama_lengkap' => 'Gunawan',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa52->nama_lengkap,
            'email' => 'gunawan@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa52->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 53
        $siswa53 = Siswa::create([
            'nis' => '20250053',
            'nama_lengkap' => 'Hadi',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa53->nama_lengkap,
            'email' => 'hadi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa53->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 54
        $siswa54 = Siswa::create([
            'nis' => '20250054',
            'nama_lengkap' => 'Haikal',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa54->nama_lengkap,
            'email' => 'haikal@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa54->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 55
        $siswa55 = Siswa::create([
            'nis' => '20250055',
            'nama_lengkap' => 'Hamdan',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa55->nama_lengkap,
            'email' => 'hamdan@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa55->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 56
        $siswa56 = Siswa::create([
            'nis' => '20250056',
            'nama_lengkap' => 'Hendra',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa56->nama_lengkap,
            'email' => 'hendra@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa56->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 57
        $siswa57 = Siswa::create([
            'nis' => '20250057',
            'nama_lengkap' => 'Heri',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa57->nama_lengkap,
            'email' => 'heri@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa57->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 58
        $siswa58 = Siswa::create([
            'nis' => '20250058',
            'nama_lengkap' => 'Hilmi',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa58->nama_lengkap,
            'email' => 'hilmi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa58->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 59
        $siswa59 = Siswa::create([
            'nis' => '20250059',
            'nama_lengkap' => 'Ibnu',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa59->nama_lengkap,
            'email' => 'ibnu@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa59->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 60
        $siswa60 = Siswa::create([
            'nis' => '20250060',
            'nama_lengkap' => 'Ihsan',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas2->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa60->nama_lengkap,
            'email' => 'ihsan@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa60->id_siswa,
            'is_active' => true,
        ]);


        // Siswa Kelas 11 MIPA 2
        $siswa61 = Siswa::create([
            'nis' => '20250061',
            'nama_lengkap' => 'Teri',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa61->nama_lengkap,
            'email' => 'teri@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa61->id_siswa,
            'is_active' => true,
        ]);

        $siswa62 = Siswa::create([
            'nis' => '20250062',
            'nama_lengkap' => 'Teddy',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa62->nama_lengkap,
            'email' => 'teddy@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa62->id_siswa,
            'is_active' => true,
        ]);

        $siswa63 = Siswa::create([
            'nis' => '20250063',
            'nama_lengkap' => 'Reni',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas3->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa63->nama_lengkap,
            'email' => 'reni@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa63->id_siswa,
            'is_active' => true,
        ]);

        $siswa64 = Siswa::create([
            'nis' => '20250064',
            'nama_lengkap' => 'Welly',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa64->nama_lengkap,
            'email' => 'welly@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa64->id_siswa,
            'is_active' => true,
        ]);

        $siswa65 = Siswa::create([
            'nis' => '20250065',
            'nama_lengkap' => 'Yopi',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa65->nama_lengkap,
            'email' => 'yopi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa65->id_siswa,
            'is_active' => true,
        ]);

        $siswa66 = Siswa::create([
            'nis' => '20250066',
            'nama_lengkap' => 'Yosu',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa66->nama_lengkap,
            'email' => 'yosu@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa66->id_siswa,
            'is_active' => true,
        ]);

        $siswa67 = Siswa::create([
            'nis' => '20250067',
            'nama_lengkap' => 'Qinta',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas3->id_kelas
         ]);

        User::create([
            'nama_lengkap' => $siswa67->nama_lengkap,
            'email' => 'qinta@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa67->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 68
        $siswa68 = Siswa::create([
            'nis' => '20250068',
            'nama_lengkap' => 'Ilham',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa68->nama_lengkap,
            'email' => 'ilham@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa68->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 69
        $siswa69 = Siswa::create([
            'nis' => '20250069',
            'nama_lengkap' => 'Indra',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa69->nama_lengkap,
            'email' => 'indra@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa69->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 70
        $siswa70 = Siswa::create([
            'nis' => '20250070',
            'nama_lengkap' => 'Irfan',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa70->nama_lengkap,
            'email' => 'irfan@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa70->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 71
        $siswa71 = Siswa::create([
            'nis' => '20250071',
            'nama_lengkap' => 'Iskandar',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa71->nama_lengkap,
            'email' => 'iskandar@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa71->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 72
        $siswa72 = Siswa::create([
            'nis' => '20250072',
            'nama_lengkap' => 'Ivan',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa72->nama_lengkap,
            'email' => 'ivan@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa72->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 73
        $siswa73 = Siswa::create([
            'nis' => '20250073',
            'nama_lengkap' => 'Jefri',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa73->nama_lengkap,
            'email' => 'jefri@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa73->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 74
        $siswa74 = Siswa::create([
            'nis' => '20250074',
            'nama_lengkap' => 'Johan',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa74->nama_lengkap,
            'email' => 'johan@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa74->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 75
        $siswa75 = Siswa::create([
            'nis' => '20250075',
            'nama_lengkap' => 'Joni',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa75->nama_lengkap,
            'email' => 'joni@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa75->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 76
        $siswa76 = Siswa::create([
            'nis' => '20250076',
            'nama_lengkap' => 'Julian',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa76->nama_lengkap,
            'email' => 'julian@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa76->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 77
        $siswa77 = Siswa::create([
            'nis' => '20250077',
            'nama_lengkap' => 'Juned',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa77->nama_lengkap,
            'email' => 'juned@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa77->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 78
        $siswa78 = Siswa::create([
            'nis' => '20250078',
            'nama_lengkap' => 'Kurnia',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa78->nama_lengkap,
            'email' => 'kurnia@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa78->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 79
        $siswa79 = Siswa::create([
            'nis' => '20250079',
            'nama_lengkap' => 'Luthfi',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa79->nama_lengkap,
            'email' => 'luthfi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa79->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 80
        $siswa80 = Siswa::create([
            'nis' => '20250080',
            'nama_lengkap' => 'Maulana',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa80->nama_lengkap,
            'email' => 'maulana@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa80->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 81
        $siswa81 = Siswa::create([
            'nis' => '20250081',
            'nama_lengkap' => 'Maman',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa81->nama_lengkap,
            'email' => 'maman@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa81->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 82
        $siswa82 = Siswa::create([
            'nis' => '20250082',
            'nama_lengkap' => 'Mario',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa82->nama_lengkap,
            'email' => 'mario@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa82->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 83
        $siswa83 = Siswa::create([
            'nis' => '20250083',
            'nama_lengkap' => 'Miftah',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa83->nama_lengkap,
            'email' => 'miftah@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa83->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 84
        $siswa84 = Siswa::create([
            'nis' => '20250084',
            'nama_lengkap' => 'Miko',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa84->nama_lengkap,
            'email' => 'miko@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa84->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 85
        $siswa85 = Siswa::create([
            'nis' => '20250085',
            'nama_lengkap' => 'Muhammad',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa85->nama_lengkap,
            'email' => 'muhammad@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa85->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 86
        $siswa86 = Siswa::create([
            'nis' => '20250086',
            'nama_lengkap' => 'Nanda',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa86->nama_lengkap,
            'email' => 'nanda@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa86->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 87
        $siswa87 = Siswa::create([
            'nis' => '20250087',
            'nama_lengkap' => 'Naufal',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa87->nama_lengkap,
            'email' => 'naufal@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa87->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 88
        $siswa88 = Siswa::create([
            'nis' => '20250088',
            'nama_lengkap' => 'Niko',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa88->nama_lengkap,
            'email' => 'niko@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa88->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 89
        $siswa89 = Siswa::create([
            'nis' => '20250089',
            'nama_lengkap' => 'Noval',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa89->nama_lengkap,
            'email' => 'noval@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa89->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 90
        $siswa90 = Siswa::create([
            'nis' => '20250090',
            'nama_lengkap' => 'Opan',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas3->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa90->nama_lengkap,
            'email' => 'opan@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa90->id_siswa,
            'is_active' => true,
        ]);

        // Siswa Kelas 11 MIPS 2
        // Siswa 91
        $siswa91 = Siswa::create([
            'nis' => '20250091',
            'nama_lengkap' => 'Opik',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa91->nama_lengkap,
            'email' => 'opik@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa91->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 92
        $siswa92 = Siswa::create([
            'nis' => '20250092',
            'nama_lengkap' => 'Pandu',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa92->nama_lengkap,
            'email' => 'pandu@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa92->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 93
        $siswa93 = Siswa::create([
            'nis' => '20250093',
            'nama_lengkap' => 'Prasetyo',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa93->nama_lengkap,
            'email' => 'prasetyo@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa93->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 94
        $siswa94 = Siswa::create([
            'nis' => '20250094',
            'nama_lengkap' => 'Putra',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa94->nama_lengkap,
            'email' => 'putra@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa94->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 95
        $siswa95 = Siswa::create([
            'nis' => '20250095',
            'nama_lengkap' => 'Rahmat',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa95->nama_lengkap,
            'email' => 'rahmat@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa95->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 96
        $siswa96 = Siswa::create([
            'nis' => '20250096',
            'nama_lengkap' => 'Rama',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa96->nama_lengkap,
            'email' => 'rama@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa96->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 97
        $siswa97 = Siswa::create([
            'nis' => '20250097',
            'nama_lengkap' => 'Rangga',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa97->nama_lengkap,
            'email' => 'rangga@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa97->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 98
        $siswa98 = Siswa::create([
            'nis' => '20250098',
            'nama_lengkap' => 'Rendi',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa98->nama_lengkap,
            'email' => 'rendi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa98->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 99
        $siswa99 = Siswa::create([
            'nis' => '20250099',
            'nama_lengkap' => 'Rian',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa99->nama_lengkap,
            'email' => 'rian@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa99->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 100
        $siswa100 = Siswa::create([
            'nis' => '20250100',
            'nama_lengkap' => 'Ridho',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa100->nama_lengkap,
            'email' => 'ridho@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa100->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 101
        $siswa101 = Siswa::create([
            'nis' => '20250101',
            'nama_lengkap' => 'Rifki',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa101->nama_lengkap,
            'email' => 'rifki@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa101->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 102
        $siswa102 = Siswa::create([
            'nis' => '20250102',
            'nama_lengkap' => 'Rizal',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa102->nama_lengkap,
            'email' => 'rizal@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa102->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 103
        $siswa103 = Siswa::create([
            'nis' => '20250103',
            'nama_lengkap' => 'Robin',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa103->nama_lengkap,
            'email' => 'robin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa103->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 104
        $siswa104 = Siswa::create([
            'nis' => '20250104',
            'nama_lengkap' => 'Robi',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa104->nama_lengkap,
            'email' => 'robi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa104->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 105
        $siswa105 = Siswa::create([
            'nis' => '20250105',
            'nama_lengkap' => 'Roy',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa105->nama_lengkap,
            'email' => 'roy@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa105->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 106
        $siswa106 = Siswa::create([
            'nis' => '20250106',
            'nama_lengkap' => 'Sandi',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa106->nama_lengkap,
            'email' => 'sandi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa106->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 107
        $siswa107 = Siswa::create([
            'nis' => '20250107',
            'nama_lengkap' => 'Saputra',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa107->nama_lengkap,
            'email' => 'saputra@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa107->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 108
        $siswa108 = Siswa::create([
            'nis' => '20250108',
            'nama_lengkap' => 'Setiawan',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa108->nama_lengkap,
            'email' => 'setiawan@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa108->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 109
        $siswa109 = Siswa::create([
            'nis' => '20250109',
            'nama_lengkap' => 'Sholeh',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa109->nama_lengkap,
            'email' => 'sholeh@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa109->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 110
        $siswa110 = Siswa::create([
            'nis' => '20250110',
            'nama_lengkap' => 'Sidik',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa110->nama_lengkap,
            'email' => 'sidik@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa110->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 111
        $siswa111 = Siswa::create([
            'nis' => '20250111',
            'nama_lengkap' => 'Sigit',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa111->nama_lengkap,
            'email' => 'sigit@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa111->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 112
        $siswa112 = Siswa::create([
            'nis' => '20250112',
            'nama_lengkap' => 'Slamet',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa112->nama_lengkap,
            'email' => 'slamet@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa112->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 113
        $siswa113 = Siswa::create([
            'nis' => '20250113',
            'nama_lengkap' => 'Sony',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa113->nama_lengkap,
            'email' => 'sony@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa113->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 114
        $siswa114 = Siswa::create([
            'nis' => '20250114',
            'nama_lengkap' => 'Subhan',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa114->nama_lengkap,
            'email' => 'subhan@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa114->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 115
        $siswa115 = Siswa::create([
            'nis' => '20250115',
            'nama_lengkap' => 'Sukma',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa115->nama_lengkap,
            'email' => 'sukma@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa115->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 116
        $siswa116 = Siswa::create([
            'nis' => '20250116',
            'nama_lengkap' => 'Sultan',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa116->nama_lengkap,
            'email' => 'sultan@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa116->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 117
        $siswa117 = Siswa::create([
            'nis' => '20250117',
            'nama_lengkap' => 'Susanto',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa117->nama_lengkap,
            'email' => 'susanto@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa117->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 118
        $siswa118 = Siswa::create([
            'nis' => '20250118',
            'nama_lengkap' => 'Syahrul',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa118->nama_lengkap,
            'email' => 'syahrul@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa118->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 119
        $siswa119 = Siswa::create([
            'nis' => '20250119',
            'nama_lengkap' => 'Taufik',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa119->nama_lengkap,
            'email' => 'taufik@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa119->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 120
        $siswa120 = Siswa::create([
            'nis' => '20250120',
            'nama_lengkap' => 'Teguh',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas4->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa120->nama_lengkap,
            'email' => 'teguh@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa120->id_siswa,
            'is_active' => true,
        ]);
        // Siswa Kelas 12 MIPA 3
        // Siswa 121
        $siswa121 = Siswa::create([
            'nis' => '20250121',
            'nama_lengkap' => 'Tono',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa121->nama_lengkap,
            'email' => 'tono@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa121->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 122
        $siswa122 = Siswa::create([
            'nis' => '20250122',
            'nama_lengkap' => 'Ucrit',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa122->nama_lengkap,
            'email' => 'ucrit@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa122->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 123
        $siswa123 = Siswa::create([
            'nis' => '20250123',
            'nama_lengkap' => 'Udin',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa123->nama_lengkap,
            'email' => 'udin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa123->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 124
        $siswa124 = Siswa::create([
            'nis' => '20250124',
            'nama_lengkap' => 'Umar',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa124->nama_lengkap,
            'email' => 'umar@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa124->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 125
        $siswa125 = Siswa::create([
            'nis' => '20250125',
            'nama_lengkap' => 'Usman',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa125->nama_lengkap,
            'email' => 'usman@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa125->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 126
        $siswa126 = Siswa::create([
            'nis' => '20250126',
            'nama_lengkap' => 'Wahyu',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa126->nama_lengkap,
            'email' => 'wahyu@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa126->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 127
        $siswa127 = Siswa::create([
            'nis' => '20250127',
            'nama_lengkap' => 'Wawan',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa127->nama_lengkap,
            'email' => 'wawan@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa127->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 128
        $siswa128 = Siswa::create([
            'nis' => '20250128',
            'nama_lengkap' => 'Widodo',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa128->nama_lengkap,
            'email' => 'widodo@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa128->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 129
        $siswa129 = Siswa::create([
            'nis' => '20250129',
            'nama_lengkap' => 'Yanto',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa129->nama_lengkap,
            'email' => 'yanto@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa129->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 130
        $siswa130 = Siswa::create([
            'nis' => '20250130',
            'nama_lengkap' => 'Yayan',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa130->nama_lengkap,
            'email' => 'yayan@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa130->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 131
        $siswa131 = Siswa::create([
            'nis' => '20250131',
            'nama_lengkap' => 'Yoga',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa131->nama_lengkap,
            'email' => 'yoga@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa131->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 132
        $siswa132 = Siswa::create([
            'nis' => '20250132',
            'nama_lengkap' => 'Yudi',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa132->nama_lengkap,
            'email' => 'yudi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa132->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 133
        $siswa133 = Siswa::create([
            'nis' => '20250133',
            'nama_lengkap' => 'Yusuf',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa133->nama_lengkap,
            'email' => 'yusuf@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa133->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 134
        $siswa134 = Siswa::create([
            'nis' => '20250134',
            'nama_lengkap' => 'Zaki',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa134->nama_lengkap,
            'email' => 'zaki@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa134->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 135
        $siswa135 = Siswa::create([
            'nis' => '20250135',
            'nama_lengkap' => 'Zulfan',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa135->nama_lengkap,
            'email' => 'zulfan@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa135->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 136
        $siswa136 = Siswa::create([
            'nis' => '20250136',
            'nama_lengkap' => 'Zulham',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa136->nama_lengkap,
            'email' => 'zulham@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa136->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 137
        $siswa137 = Siswa::create([
            'nis' => '20250137',
            'nama_lengkap' => 'Zulkarnaen',
            'jenis_kelamin' => 'L',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa137->nama_lengkap,
            'email' => 'zulkarnaen@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa137->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 138
        $siswa138 = Siswa::create([
            'nis' => '20250138',
            'nama_lengkap' => 'Amel',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa138->nama_lengkap,
            'email' => 'amel@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa138->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 139
        $siswa139 = Siswa::create([
            'nis' => '20250139',
            'nama_lengkap' => 'Amelia',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa139->nama_lengkap,
            'email' => 'amelia@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa139->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 140
        $siswa140 = Siswa::create([
            'nis' => '20250140',
            'nama_lengkap' => 'Ayu',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa140->nama_lengkap,
            'email' => 'ayu@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa140->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 141
        $siswa141 = Siswa::create([
            'nis' => '20250141',
            'nama_lengkap' => 'Bella',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa141->nama_lengkap,
            'email' => 'bella@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa141->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 142
        $siswa142 = Siswa::create([
            'nis' => '20250142',
            'nama_lengkap' => 'Bunga',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa142->nama_lengkap,
            'email' => 'bunga@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa142->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 143
        $siswa143 = Siswa::create([
            'nis' => '20250143',
            'nama_lengkap' => 'Citra',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa143->nama_lengkap,
            'email' => 'citra@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa143->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 144
        $siswa144 = Siswa::create([
            'nis' => '20250144',
            'nama_lengkap' => 'Dela',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa144->nama_lengkap,
            'email' => 'dela@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa144->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 145
        $siswa145 = Siswa::create([
            'nis' => '20250145',
            'nama_lengkap' => 'Desi',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa145->nama_lengkap,
            'email' => 'desi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa145->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 146
        $siswa146 = Siswa::create([
            'nis' => '20250146',
            'nama_lengkap' => 'Dewi',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa146->nama_lengkap,
            'email' => 'dewi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa146->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 147
        $siswa147 = Siswa::create([
            'nis' => '20250147',
            'nama_lengkap' => 'Dina',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa147->nama_lengkap,
            'email' => 'dina@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa147->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 148
        $siswa148 = Siswa::create([
            'nis' => '20250148',
            'nama_lengkap' => 'Eka',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa148->nama_lengkap,
            'email' => 'eka@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa148->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 149
        $siswa149 = Siswa::create([
            'nis' => '20250149',
            'nama_lengkap' => 'Elsa',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa149->nama_lengkap,
            'email' => 'elsa@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa149->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 150
        $siswa150 = Siswa::create([
            'nis' => '20250150',
            'nama_lengkap' => 'Fitri',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas5->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa150->nama_lengkap,
            'email' => 'fitri@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa150->id_siswa,
            'is_active' => true,
        ]);

        // Siswa Kelas 12 MIPS 3

        // Siswa 151
        $siswa151 = Siswa::create([
            'nis' => '20250151',
            'nama_lengkap' => 'Gina',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa151->nama_lengkap,
            'email' => 'gina@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa151->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 152
        $siswa152 = Siswa::create([
            'nis' => '20250152',
            'nama_lengkap' => 'Hani',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa152->nama_lengkap,
            'email' => 'hani@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa152->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 153
        $siswa153 = Siswa::create([
            'nis' => '20250153',
            'nama_lengkap' => 'Icha',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa153->nama_lengkap,
            'email' => 'icha@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa153->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 154
        $siswa154 = Siswa::create([
            'nis' => '20250154',
            'nama_lengkap' => 'Indah',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa154->nama_lengkap,
            'email' => 'indah@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa154->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 155
        $siswa155 = Siswa::create([
            'nis' => '20250155',
            'nama_lengkap' => 'Intan',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa155->nama_lengkap,
            'email' => 'intan@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa155->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 156
        $siswa156 = Siswa::create([
            'nis' => '20250156',
            'nama_lengkap' => 'Kartika',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa156->nama_lengkap,
            'email' => 'kartika@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa156->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 157
        $siswa157 = Siswa::create([
            'nis' => '20250157',
            'nama_lengkap' => 'Lina',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa157->nama_lengkap,
            'email' => 'lina@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa157->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 158
        $siswa158 = Siswa::create([
            'nis' => '20250158',
            'nama_lengkap' => 'Lisa',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa158->nama_lengkap,
            'email' => 'lisa@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa158->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 159
        $siswa159 = Siswa::create([
            'nis' => '20250159',
            'nama_lengkap' => 'Maria',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa159->nama_lengkap,
            'email' => 'maria@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa159->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 160
        $siswa160 = Siswa::create([
            'nis' => '20250160',
            'nama_lengkap' => 'Maya',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa160->nama_lengkap,
            'email' => 'maya@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa160->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 161
        $siswa161 = Siswa::create([
            'nis' => '20250161',
            'nama_lengkap' => 'Mega',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa161->nama_lengkap,
            'email' => 'mega@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa161->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 162
        $siswa162 = Siswa::create([
            'nis' => '20250162',
            'nama_lengkap' => 'Mila',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa162->nama_lengkap,
            'email' => 'mila@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa162->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 163
        $siswa163 = Siswa::create([
            'nis' => '20250163',
            'nama_lengkap' => 'Nina',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa163->nama_lengkap,
            'email' => 'nina@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa163->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 164
        $siswa164 = Siswa::create([
            'nis' => '20250164',
            'nama_lengkap' => 'Nita',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa164->nama_lengkap,
            'email' => 'nita@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa164->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 165
        $siswa165 = Siswa::create([
            'nis' => '20250165',
            'nama_lengkap' => 'Novia',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa165->nama_lengkap,
            'email' => 'novia@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa165->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 166
        $siswa166 = Siswa::create([
            'nis' => '20250166',
            'nama_lengkap' => 'Nuri',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa166->nama_lengkap,
            'email' => 'nuri@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa166->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 167
        $siswa167 = Siswa::create([
            'nis' => '20250167',
            'nama_lengkap' => 'Okta',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa167->nama_lengkap,
            'email' => 'okta@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa167->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 168
        $siswa168 = Siswa::create([
            'nis' => '20250168',
            'nama_lengkap' => 'Putri',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa168->nama_lengkap,
            'email' => 'putri@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa168->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 169
        $siswa169 = Siswa::create([
            'nis' => '20250169',
            'nama_lengkap' => 'Ratna',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa169->nama_lengkap,
            'email' => 'ratna@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa169->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 170
        $siswa170 = Siswa::create([
            'nis' => '20250170',
            'nama_lengkap' => 'Rina',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa170->nama_lengkap,
            'email' => 'rina@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa170->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 171
        $siswa171 = Siswa::create([
            'nis' => '20250171',
            'nama_lengkap' => 'Risa',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa171->nama_lengkap,
            'email' => 'risa@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa171->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 172
        $siswa172 = Siswa::create([
            'nis' => '20250172',
            'nama_lengkap' => 'Sari',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa172->nama_lengkap,
            'email' => 'sari@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa172->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 173
        $siswa173 = Siswa::create([
            'nis' => '20250173',
            'nama_lengkap' => 'Sinta',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa173->nama_lengkap,
            'email' => 'sinta@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa173->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 174
        $siswa174 = Siswa::create([
            'nis' => '20250174',
            'nama_lengkap' => 'Tari',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa174->nama_lengkap,
            'email' => 'tari@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa174->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 175
        $siswa175 = Siswa::create([
            'nis' => '20250175',
            'nama_lengkap' => 'Tika',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa175->nama_lengkap,
            'email' => 'tika@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa175->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 176
        $siswa176 = Siswa::create([
            'nis' => '20250176',
            'nama_lengkap' => 'Tina',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa176->nama_lengkap,
            'email' => 'tina@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa176->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 177
        $siswa177 = Siswa::create([
            'nis' => '20250177',
            'nama_lengkap' => 'Vani',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa177->nama_lengkap,
            'email' => 'vani@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa177->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 178
        $siswa178 = Siswa::create([
            'nis' => '20250178',
            'nama_lengkap' => 'Vina',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa178->nama_lengkap,
            'email' => 'vina@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa178->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 179
        $siswa179 = Siswa::create([
            'nis' => '20250179',
            'nama_lengkap' => 'Winda',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa179->nama_lengkap,
            'email' => 'winda@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa179->id_siswa,
            'is_active' => true,
        ]);

        // Siswa 180
        $siswa180 = Siswa::create([
            'nis' => '20250180',
            'nama_lengkap' => 'Yuni',
            'jenis_kelamin' => 'P',
            'id_kelas' => $kelas6->id_kelas
        ]);

        User::create([
            'nama_lengkap' => $siswa180->nama_lengkap,
            'email' => 'yuni@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'id_siswa' => $siswa180->id_siswa,
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
