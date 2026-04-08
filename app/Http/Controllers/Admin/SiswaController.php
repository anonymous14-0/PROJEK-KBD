<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all();
        return view('admin.siswa.index', compact('siswa'));
    }

    public function create()
    {
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
            // 1. Buat Akun User untuk Siswa
            User::create([
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->nis . '@siakad.com', // Email otomatis dari NIS
                'password' => bcrypt('password123'),
                'role' => 'siswa',
                'is_active' => true,
            ]);

            // 2. Simpan Data ke Tabel Siswa
            Siswa::create([
                'nis' => $request->nis,
                'nama_lengkap' => $request->nama_lengkap,
                'jenis_kelamin' => $request->jenis_kelamin,
                'id_kelas' => $request->id_kelas,
            ]);

            DB::commit();
            return redirect()->route('admin.siswa.index')->with('success', 'Data Siswa & Akun Berhasil Dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }
}