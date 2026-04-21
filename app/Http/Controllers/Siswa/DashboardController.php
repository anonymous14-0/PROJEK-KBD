<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\AktivitasLog;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data nilai HANYA milik siswa yang sedang login
        $nilai = Nilai::with('mata_pelajaran')
                      ->where('id_siswa', auth()->id())
                      ->get();

        // KBD: Catat aktivitas bahwa siswa mengecek nilai (audit trail)
        AktivitasLog::create([
            'id_user' => auth()->id(),
            'aktivitas' => "Siswa melihat daftar nilai pribadi",
            'created_at' => now(),
        ]);

        return view('siswa.dashboard', compact('nilai'));
    }
}