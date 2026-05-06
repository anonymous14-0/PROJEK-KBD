<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Services\AuditTrail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $idSiswa = Auth::user()->id_siswa;

        $nilai = Nilai::with('mataPelajaran')
            ->where('id_siswa', $idSiswa)
            ->latest('updated_at')
            ->get();

        AuditTrail::record('Siswa melihat daftar nilai pribadi', $request);

        return view('siswa.dashboard', compact('nilai'));
    }
}
