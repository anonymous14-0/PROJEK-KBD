<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AuditTrail;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $siswa = Siswa::all();
        AuditTrail::record('Admin melihat daftar siswa', $request);
        return view('admin.siswa.index', compact('siswa'));
    }

    public function create(Request $request)
    {
        AuditTrail::record('Admin membuka form tambah siswa', $request);

        // Ambil data kelas untuk pilihan di Dropdown Form
        $kelas = DB::table('kelas')->get();
        return view('admin.siswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswa,nis|unique:users,email',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'id_kelas' => 'required|exists:kelas,id_kelas',
        ]);

        DB::beginTransaction();
        try {
            // 1. Simpan Data ke Tabel Siswa
            $siswa = Siswa::create([
                'nis' => $request->nis,
                'nama_lengkap' => $request->nama_lengkap,
                'jenis_kelamin' => $request->jenis_kelamin,
                'id_kelas' => $request->id_kelas,
            ]);

            // 2. Buat Akun User untuk Siswa dan tautkan ke profil siswa
            User::create([
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->nis . '@siakad.com', // Email otomatis dari NIS
                'password' => bcrypt('password123'),
                'role' => 'siswa',
                'id_siswa' => $siswa->id_siswa,
                'is_active' => true,
            ]);

            DB::commit();

            AuditTrail::record("Admin menambahkan siswa ID {$siswa->id_siswa}", $request);

            return redirect()->route('admin.siswa.index')->with('success', 'Data Siswa & Akun Berhasil Dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }
}