<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AuditTrail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

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

        $kelas = DB::table('kelas')->get();
        return view('admin.siswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $email = $request->input('nis').'@siakad.com';

        // Pengecekan unique dihapus dari bawaan Laravel
        $validated = $request->validate([
            'nis' => ['required', 'string', 'max:50'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'id_kelas' => ['required', 'integer', 'exists:kelas,id_kelas'],
        ]);

        // Cek Unique Manual NIS (Enkripsi dulu nilainya baru dicek ke DB)
        $encryptedNis = Siswa::encryptData($request->input('nis'));
        if (Siswa::where('nis', $encryptedNis)->exists()) {
            throw ValidationException::withMessages([
                'nis' => 'NIS sudah digunakan.',
            ]);
        }

        // Cek Unique Manual Email Akun Siswa
        $encryptedEmail = User::encryptData($email);
        if (User::where('email', $encryptedEmail)->exists()) {
            throw ValidationException::withMessages([
                'nis' => 'Email akun siswa otomatis sudah digunakan.',
            ]);
        }

        $temporaryPassword = Str::password(16);

        try {
            $siswa = DB::transaction(function () use ($validated, $email, $temporaryPassword) {
                $siswa = Siswa::create($validated);

                User::create([
                    'nama_lengkap' => $validated['nama_lengkap'],
                    'email' => $email, // Akan otomatis dienkripsi oleh model
                    'password' => Hash::make($temporaryPassword),
                    'role' => 'siswa',
                    'id_siswa' => $siswa->id_siswa,
                    'is_active' => true,
                    'must_change_password' => true,
                ]);

                return $siswa;
            });
        } catch (\Throwable $e) {
            Log::error('Gagal membuat siswa dan akun login', [
                'nis' => $request->input('nis'),
                'ip_address' => $request->ip(),
                'exception' => $e,
            ]);

            return back()->withInput()->with('error', 'Gagal menyimpan data siswa. Silakan coba lagi.');
        }

        AuditTrail::record("Admin menambahkan siswa ID {$siswa->id_siswa}", $request);

        return redirect()->route('admin.siswa.index')->with([
            'success' => 'Data Siswa & Akun berhasil dibuat. Berikan password sementara ini kepada siswa dan minta segera diganti.',
            'temporary_password' => $temporaryPassword,
            'temporary_account_email' => $email, // Tampilkan balikan tetap plaintext
        ]);
    }
}
