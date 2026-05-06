<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User; // Pastikan User juga di-import
use App\Services\AuditTrail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $gurus = Guru::all();
        AuditTrail::record('Admin melihat daftar guru', $request);
        return view('admin.guru.index', compact('gurus'));
    }

    public function create(Request $request)
    {
        AuditTrail::record('Admin membuka form tambah guru', $request);

        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nip' => 'required|unique:guru,nip',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        // 2. Simpan Profil Guru di tabel guru
        $guru = Guru::create([
            'nip' => $request->nip,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        // 3. Buat Akun Login di tabel users dan tautkan ke profil guru
        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->nip . '@siakad.com', // Contoh: 12345@siakad.com
            'password' => Hash::make('password123'), // Gunakan Hash agar aman
            'role' => 'guru',
            'id_guru' => $guru->id_guru,
            'is_active' => true,
        ]);

        AuditTrail::record("Admin menambahkan guru ID {$guru->id_guru}", $request);

        return redirect()->route('admin.guru.index')->with('success', 'Guru & Akun Login berhasil dibuat!');
    }
}