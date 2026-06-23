<?php

namespace App\Http\Controllers\Siswa;

// Controller dasar Laravel sebagai induk controller dashboard siswa.
use App\Http\Controllers\Controller;
// Model Nilai digunakan untuk mengambil data nilai siswa dari database.
use App\Models\Nilai;
// Service AuditTrail digunakan untuk mencatat aktivitas siswa saat melihat dashboard.
use App\Services\AuditTrail;
// Request membawa informasi permintaan HTTP yang sedang diproses.
use Illuminate\Http\Request;
// Facade Auth digunakan untuk mengambil data user yang sedang login.
use Illuminate\Support\Facades\Auth;

// Class ini bertanggung jawab menampilkan dashboard siswa beserta nilai pribadinya.
class DashboardController extends Controller
{
    /**
     * Menampilkan daftar nilai milik siswa yang sedang login.
     */
    public function index(Request $request)
    {
        // Mengambil id_siswa dari akun user yang sedang login.
        $idSiswa = Auth::user()->id_siswa;

        // Mengambil nilai siswa dari database beserta data mata pelajaran terkait.
        $nilai = Nilai::with('mataPelajaran')
            ->where('id_siswa', $idSiswa)
            ->latest('updated_at')
            ->get();

        // Mencatat aktivitas siswa ketika membuka dashboard nilai pribadi.
        AuditTrail::record('Siswa melihat daftar nilai pribadi', $request);

        // Mengirim data nilai ke halaman dashboard siswa.
        return view('siswa.dashboard', compact('nilai'));
    }
}
