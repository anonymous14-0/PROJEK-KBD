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
        $siswa = Siswa::with('kelas')->get();
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

    public function edit(Request $request, Siswa $siswa)
    {
        AuditTrail::record("Admin membuka form edit siswa ID {$siswa->id_siswa}", $request);

        $kelas = DB::table('kelas')->get();
        return view('admin.siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nis' => ['required', 'string', 'max:50'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'id_kelas' => ['required', 'integer', 'exists:kelas,id_kelas'],
        ]);

        $encryptedNis = Siswa::encryptData($validated['nis']);
        if (Siswa::where('nis', $encryptedNis)->whereKeyNot($siswa->id_siswa)->exists()) {
            throw ValidationException::withMessages([
                'nis' => 'NIS sudah digunakan.',
            ]);
        }

        $newEmail = $validated['nis'].'@siakad.com';
        $encryptedEmail = User::encryptData($newEmail);
        $currentUser = $siswa->user;

        if (User::where('email', $encryptedEmail)
            ->when($currentUser, fn ($query) => $query->whereKeyNot($currentUser->id_user))
            ->exists()) {
            throw ValidationException::withMessages([
                'nis' => 'Email akun siswa otomatis sudah digunakan.',
            ]);
        }

        $oldNis = $siswa->nis;
        $oldName = $siswa->nama_lengkap;

        try {
            DB::transaction(function () use ($siswa, $validated, $newEmail, $currentUser) {
                $siswa->update($validated);

                if ($currentUser) {
                    $currentUser->update([
                        'nama_lengkap' => $validated['nama_lengkap'],
                        'email' => $newEmail,
                    ]);
                }
            });
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui siswa dan akun login', [
                'id_siswa' => $siswa->id_siswa,
                'nis' => $request->input('nis'),
                'ip_address' => $request->ip(),
                'exception' => $e,
            ]);

            return back()->withInput()->with('error', 'Gagal memperbarui data siswa. Silakan coba lagi.');
        }

        AuditTrail::record(
            "Admin mengedit siswa ID {$siswa->id_siswa} dari NIS {$oldNis} / {$oldName} menjadi NIS {$validated['nis']} / {$validated['nama_lengkap']}",
            $request
        );

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Request $request, Siswa $siswa)
    {
        $siswaId = $siswa->id_siswa;
        $nis = $siswa->nis;
        $name = $siswa->nama_lengkap;

        try {
            DB::transaction(function () use ($siswa) {
                $siswa->delete();
            });
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus siswa dan akun login', [
                'id_siswa' => $siswaId,
                'nis' => $nis,
                'ip_address' => $request->ip(),
                'exception' => $e,
            ]);

            return back()->with('error', 'Gagal menghapus data siswa. Silakan coba lagi.');
        }

        AuditTrail::record("Admin menghapus siswa ID {$siswaId} dengan NIS {$nis} / {$name}", $request);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
