<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User; // Pastikan User juga di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::all(); 
        return view('admin.guru.index', compact('gurus'));
    }

    public function create()
    {
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

        // 2. Buat Akun Login di tabel users
        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->nip . '@siakad.com', // Contoh: 12345@siakad.com
            'password' => Hash::make('password123'), // Gunakan Hash agar aman
            'role' => 'guru',
            'is_active' => true,
        ]);

        // 3. Simpan Profil Guru di tabel guru
        Guru::create([
            'nip' => $request->nip,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->route('admin.guru.index')->with('success', 'Guru & Akun Login berhasil dibuat!');
    }
}