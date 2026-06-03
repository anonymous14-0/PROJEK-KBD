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
    /**
     * 1. Menampilkan halaman daftar data siswa utama (aktif)
     */
    public function index(Request $request)
    {
        // Load relasi kelas agar nama kelas muncul di tabel
        $siswa = Siswa::with('kelas')->get();

        AuditTrail::record('Admin melihat daftar siswa', $request);

        return view('admin.siswa.index', compact('siswa'));
    }

    /**
     * 2. Menampilkan form halaman tambah siswa
     */
    public function create(Request $request)
    {
        AuditTrail::record('Admin membuka form tambah siswa', $request);

        // Ambil data kelas untuk pilihan di dropdown form
        $kelas = DB::table('kelas')->get();
        return view('admin.siswa.create', compact('kelas'));
    }

    /**
     * 3. Menyimpan data siswa baru beserta pembuatan akun login otomatis
     */
    public function store(Request $request)
    {
        // Generate format email otomatis menggunakan NIS
        $email = $request->input('nis').'@siakad.com';

        // Validasi inputan form
        $validated = $request->validate([
            'nis' => ['required', 'string', 'max:50'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'id_kelas' => ['required', 'integer', 'exists:kelas,id_kelas'],
        ]);

        // Pengecekan unik NIS (menggunakan data terenkripsi)
        $encryptedNis = Siswa::encryptData($request->input('nis'));
        if (Siswa::where('nis', $encryptedNis)->exists()) {
            throw ValidationException::withMessages(['nis' => 'NIS sudah digunakan.']);
        }

        // Pengecekan unik Email (menggunakan data terenkripsi)
        $encryptedEmail = User::encryptData($email);
        if (User::where('email', $encryptedEmail)->exists()) {
            throw ValidationException::withMessages(['nis' => 'Email akun siswa otomatis sudah digunakan.']);
        }

        // Generate password acak sepanjang 16 karakter
        $temporaryPassword = Str::password(16);

        try {
            // Gunakan DB Transaction agar aman jika proses putus di tengah jalan
            $siswa = DB::transaction(function () use ($validated, $email, $temporaryPassword) {
                // Simpan ke tabel siswa
                $siswa = Siswa::create($validated);

                // Buatkan akun di tabel users
                User::create([
                    'nama_lengkap' => $validated['nama_lengkap'],
                    'email' => $email,
                    'password' => Hash::make($temporaryPassword), // Hash password
                    'role' => 'siswa',
                    'id_siswa' => $siswa->id_siswa,
                    'is_active' => true,
                    'must_change_password' => true, // Wajib ganti password saat pertama login
                ]);
                return $siswa;
            });
        } catch (\Throwable $e) {
            Log::error('Gagal membuat siswa dan akun', ['nis' => $request->input('nis'), 'exception' => $e]);
            return back()->withInput()->with('error', 'Gagal menyimpan data siswa.');
        }

        AuditTrail::record("Admin menambahkan siswa ID {$siswa->id_siswa}", $request);

        // Notifikasi SUKSES yang diperbarui (Menyertakan Email & Password langsung)
        $pesanSukses = "Data Siswa berhasil ditambahkan! Email Login: {$email} | Password: {$temporaryPassword} | Catatan: User diwajibkan mengganti password ini saat login pertama kali.";

        return redirect()->route('admin.siswa.index')->with([
            'success' => $pesanSukses,
            'temporary_password' => $temporaryPassword,
            'temporary_account_email' => $email,
        ]);
    }

    /**
     * 4. Menampilkan form halaman edit data siswa
     */
    public function edit(Request $request, Siswa $siswa)
    {
        AuditTrail::record("Admin membuka form edit siswa ID {$siswa->id_siswa}", $request);
        $kelas = DB::table('kelas')->get();
        return view('admin.siswa.edit', compact('siswa', 'kelas'));
    }

    /**
     * 5. Memproses pembaruan data siswa dan akun loginnya
     */
    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nis' => ['required', 'string', 'max:50'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'id_kelas' => ['required', 'integer', 'exists:kelas,id_kelas'],
        ]);

        // Cek unik NIS kecuali milik siswa ini sendiri
        $encryptedNis = Siswa::encryptData($validated['nis']);
        if (Siswa::where('nis', $encryptedNis)->whereKeyNot($siswa->id_siswa)->exists()) {
            throw ValidationException::withMessages(['nis' => 'NIS sudah digunakan.']);
        }

        // Format ulang email jika NIS berubah
        $newEmail = $validated['nis'].'@siakad.com';
        $encryptedEmail = User::encryptData($newEmail);
        $currentUser = $siswa->user;

        // Cek unik email
        if (User::where('email', $encryptedEmail)->when($currentUser, fn ($query) => $query->whereKeyNot($currentUser->id_user))->exists()) {
            throw ValidationException::withMessages(['nis' => 'Email akun otomatis digunakan.']);
        }

        try {
            DB::transaction(function () use ($siswa, $validated, $newEmail, $currentUser) {
                $siswa->update($validated);
                if ($currentUser) {
                    $currentUser->update(['nama_lengkap' => $validated['nama_lengkap'], 'email' => $newEmail]);
                }
            });
        } catch (\Throwable $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui data siswa.');
        }

        AuditTrail::record("Admin mengedit siswa ID {$siswa->id_siswa}", $request);
        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * 6. Memindahkan data siswa ke tempat sampah (Soft Delete)
     */
    public function destroy(Request $request, Siswa $siswa)
    {
        $siswaId = $siswa->id_siswa;

        try {
            DB::transaction(function () use ($siswa, $siswaId) {
                // Soft delete User agar akses login terputus
                $userAkun = User::where('id_siswa', $siswaId)->first();
                if ($userAkun) $userAkun->delete();

                // Soft delete Siswanya
                $siswa->delete();
            });
        } catch (\Throwable $e) {
            Log::error('Gagal soft delete siswa', ['id_siswa' => $siswaId, 'exception' => $e]);
            return back()->with('error', 'Gagal menghapus data siswa.');
        }

        AuditTrail::record("Admin menghapus (soft-delete) siswa ID {$siswaId}", $request);
        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa dipindahkan ke Tempat Sampah.');
    }

    /**
     * 7. Menampilkan halaman tempat sampah (Trash)
     */
    public function trashed(Request $request)
    {
        $siswa = Siswa::onlyTrashed()->get();
        AuditTrail::record('Admin melihat tempat sampah siswa', $request);
        return view('admin.siswa.trashed', compact('siswa'));
    }

    /**
     * 8. Memulihkan data siswa dari tempat sampah (Restore)
     */
    public function restore(Request $request, $id)
    {
        try {
            // Restore siswa
            $siswa = Siswa::onlyTrashed()->findOrFail($id);
            $siswa->restore();

            // Restore akses login
            $userAkun = User::onlyTrashed()->where('id_siswa', $id)->first();
            if ($userAkun) $userAkun->restore();

            AuditTrail::record("Admin memulihkan data siswa: {$siswa->nama_lengkap}", $request);
            return redirect()->route('admin.siswa.trashed')->with('success', 'Data siswa dan akun login berhasil dipulihkan.');
        } catch (\Throwable $e) {
            return redirect()->route('admin.siswa.trashed')->with('error', 'Gagal memulihkan data.');
        }
    }

    /**
     * 9. Menghapus permanen data siswa beserta akun loginnya (Force Delete)
     */
    public function forceDelete(Request $request, $id)
    {
        try {
            $siswa = Siswa::onlyTrashed()->findOrFail($id);
            $nama = $siswa->nama_lengkap;

            // Eksekusi hapus permanen
            $userAkun = User::onlyTrashed()->where('id_siswa', $id)->first();
            if ($userAkun) $userAkun->forceDelete();

            $siswa->forceDelete();

            AuditTrail::record("Admin MENGHAPUS PERMANEN siswa: {$nama}", $request);
            return redirect()->route('admin.siswa.trashed')->with('success', 'Data dihapus secara permanen.');
        } catch (\Throwable $e) {
            return redirect()->route('admin.siswa.trashed')->with('error', 'Gagal menghapus permanen.');
        }
    }
}
