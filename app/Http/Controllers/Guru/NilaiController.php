<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Nilai; // Pastikan model Nilai sudah ada
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        // Menampilkan daftar nilai siswa
        $nilai = Nilai::with(['siswa', 'mata_pelajaran'])->get();
        return view('guru.nilai.index', compact('nilai'));
    }

    public function edit($id)
    {
        $nilai = Nilai::findOrFail($id);
        return view('guru.nilai.edit', compact('nilai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'skor' => 'required|numeric|min:0|max:100',
        ]);

        $nilai = Nilai::findOrFail($id);
        $nilai->update(['skor' => $request->skor]);

        // Catat ke Aktivitas Log untuk Keamanan Basis Data
        \App\Models\AktivitasLog::create([
            'id_user' => auth()->id(),
            'aktivitas' => "Mengubah nilai siswa ID: {$nilai->id_siswa}",
            'created_at' => now(),
        ]);

        return redirect()->route('guru.nilai.index')->with('success', 'Nilai berhasil diperbarui');
    }
}