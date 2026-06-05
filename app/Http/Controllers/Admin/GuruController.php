<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use App\Services\AuditTrail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class GuruController extends Controller
{
    /**
     * 1. Menampilkan halaman daftar data guru utama (aktif)
     */
    public function index(Request $request)
    {
        $gurus = Guru::all();

        // Catat aktivitas melihat data
        AuditTrail::record('Admin melihat daftar guru', $request);

        return view('admin.guru.index', compact('gurus'));
    }

    /**
     * 2. Menampilkan form halaman tambah guru
     */
    public function create(Request $request)
    {
        AuditTrail::record('Admin membuka form tambah guru', $request);
        return view('admin.guru.create');
    }

    /**
     * 3. Menyimpan data guru baru beserta pembuatan akun login otomatis
     */
    public function store(Request $request)
    {
        // Generate format email otomatis menggunakan NIP
        $email = $request->input('nip').'@siakad.com';

        // Validasi inputan form
        $validated = $request->validate([
            'nip' => ['required', 'string', 'max:50'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
        ]);

        // Pengecekan unik NIP (menggunakan data terenkripsi)
        $encryptedNip = Guru::encryptData($request->input('nip'));
        if (Guru::where('nip', $encryptedNip)->exists()) {
            throw ValidationException::withMessages(['nip' => 'NIP sudah digunakan.']);
        }

        // Pengecekan unik Email (menggunakan data terenkripsi)
        $encryptedEmail = User::encryptData($email);
        if (User::where('email', $encryptedEmail)->exists()) {
            throw ValidationException::withMessages(['nip' => 'Email akun guru otomatis sudah digunakan.']);
        }

        // Generate password acak sepanjang 16 karakter
        $temporaryPassword = Str::password(16);

        try {
            // Gunakan DB Transaction agar jika satu gagal, semua di-rollback (dibatalkan)
            $guru = DB::transaction(function () use ($validated, $email, $temporaryPassword) {
                // Simpan data ke tabel guru
                $guru = Guru::create($validated);

                // Buatkan akun login di tabel users
                User::create([
                    'nama_lengkap' => $validated['nama_lengkap'],
                    'email' => $email,
                    'password' => Hash::make($temporaryPassword), // Hash password
                    'role' => 'guru',
                    'id_guru' => $guru->id_guru,
                    'is_active' => true,
                    'must_change_password' => true, // Wajib ganti password saat login pertama
                ]);
                return $guru;
            });
        } catch (\Throwable $e) {
            // Catat log jika terjadi error sistem
            Log::error('Gagal membuat guru dan akun login', ['nip' => $request->input('nip'), 'exception' => $e]);
            return back()->withInput()->with('error', 'Gagal menyimpan data guru. Silakan coba lagi.');
        }

        // Catat jejak audit
        AuditTrail::record("Admin menambahkan guru ID {$guru->id_guru}", $request);

        // Notifikasi SUKSES yang sudah diperbarui dengan detail akun
        $pesanSukses = "Data Guru berhasil ditambahkan! Email Login: {$email} | Password: {$temporaryPassword} | Catatan: User diwajibkan mengganti password ini saat login pertama kali.";

        return redirect()->route('admin.guru.index')->with([
            'success' => $pesanSukses,
            'temporary_password' => $temporaryPassword,
            'temporary_account_email' => $email,
        ]);
    }

    /**
     * 4. Menampilkan form halaman edit data guru
     */
    public function edit(Request $request, Guru $guru)
    {
        AuditTrail::record("Admin membuka form edit guru ID {$guru->id_guru}", $request);
        return view('admin.guru.edit', compact('guru'));
    }

    /**
     * 5. Memproses pembaruan data guru dan akun loginnya
     */
    public function update(Request $request, Guru $guru)
    {
        $validated = $request->validate([
            'nip' => ['required', 'string', 'max:50'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
        ]);

        // Cek unik NIP kecuali milik guru ini sendiri
        $encryptedNip = Guru::encryptData($validated['nip']);
        if (Guru::where('nip', $encryptedNip)->whereKeyNot($guru->id_guru)->exists()) {
            throw ValidationException::withMessages(['nip' => 'NIP sudah digunakan.']);
        }

        // Format ulang email jika NIP berubah
        $newEmail = $validated['nip'].'@siakad.com';
        $encryptedEmail = User::encryptData($newEmail);
        $currentUser = $guru->user;

        // Cek unik email kecuali milik guru ini sendiri
        if (User::where('email', $encryptedEmail)->when($currentUser, fn ($query) => $query->whereKeyNot($currentUser->id_user))->exists()) {
            throw ValidationException::withMessages(['nip' => 'Email akun guru otomatis sudah digunakan.']);
        }

        $before = [
            'nip' => $guru->nip,
            'nama_lengkap' => $guru->nama_lengkap,
            'jenis_kelamin' => $guru->jenis_kelamin,
            'email' => $currentUser?->email,
        ];
        $after = [
            'nip' => $validated['nip'],
            'nama_lengkap' => $validated['nama_lengkap'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'email' => $newEmail,
        ];

        try {
            DB::transaction(function () use ($guru, $validated, $newEmail, $currentUser) {
                // Update tabel guru
                $guru->update($validated);
                // Update tabel users terkait sinkronisasi nama dan email
                if ($currentUser) {
                    $currentUser->update(['nama_lengkap' => $validated['nama_lengkap'], 'email' => $newEmail]);
                }
            });
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui guru dan akun', ['id_guru' => $guru->id_guru, 'exception' => $e]);
            return back()->withInput()->with('error', 'Gagal memperbarui data guru.');
        }

        $detailPerubahan = AuditTrail::describeChanges($before, $after, [
            'nip' => 'NIP',
            'nama_lengkap' => 'Nama lengkap',
            'jenis_kelamin' => 'Jenis kelamin',
            'email' => 'Email akun',
        ]);

        AuditTrail::record("Admin mengedit guru ID {$guru->id_guru}. {$detailPerubahan}", $request);
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * 6. Memindahkan data guru ke tempat sampah (Soft Delete)
     */
    public function destroy(Request $request, Guru $guru)
    {
        $guruId = $guru->id_guru;

        try {
            DB::transaction(function () use ($guru, $guruId) {
                // Soft delete User nya dulu agar tidak bisa login
                $userAkun = User::where('id_guru', $guruId)->first();
                if ($userAkun) $userAkun->delete();

                // Soft delete data Guru
                $guru->delete();
            });
        } catch (\Throwable $e) {
            Log::error('Gagal soft delete guru', ['id_guru' => $guruId, 'exception' => $e]);
            return back()->with('error', 'Gagal menghapus data guru.');
        }

        AuditTrail::record("Admin menghapus (soft-delete) guru ID {$guruId}", $request);
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dipindahkan ke Tempat Sampah.');
    }

    /**
     * 7. Menampilkan halaman tempat sampah (Trash)
     */
    public function trashed(Request $request)
    {
        $gurus = Guru::onlyTrashed()->get();
        AuditTrail::record('Admin melihat tempat sampah guru', $request);
        return view('admin.guru.trashed', compact('gurus'));
    }

    /**
     * 8. Memulihkan data guru dari tempat sampah ke data utama (Restore)
     */
    public function restore(Request $request, $id)
    {
        try {
            // Restore data guru
            $guru = Guru::onlyTrashed()->findOrFail($id);
            $guru->restore();

            // Restore akun user loginnya
            $userAkun = User::onlyTrashed()->where('id_guru', $id)->first();
            if ($userAkun) $userAkun->restore();

            AuditTrail::record("Admin memulihkan data guru: {$guru->nama_lengkap}", $request);
            return redirect()->route('admin.guru.trashed')->with('success', 'Data guru dan akun login berhasil dipulihkan.');
        } catch (\Throwable $e) {
            return redirect()->route('admin.guru.trashed')->with('error', 'Gagal memulihkan data.');
        }
    }

    /**
     * 9. Menghapus data guru dari database untuk selamanya (Force Delete)
     */
    public function forceDelete(Request $request, $id)
    {
        try {
            $guru = Guru::onlyTrashed()->findOrFail($id);
            $namaGuru = $guru->nama_lengkap;

            // Hapus permanen user
            $userAkun = User::onlyTrashed()->where('id_guru', $id)->first();
            if ($userAkun) $userAkun->forceDelete();

            // Hapus permanen guru
            $guru->forceDelete();

            AuditTrail::record("Admin MENGHAPUS PERMANEN guru: {$namaGuru}", $request);
            return redirect()->route('admin.guru.trashed')->with('success', 'Data guru berhasil dihapus secara permanen.');
        } catch (\Throwable $e) {
            return redirect()->route('admin.guru.trashed')->with('error', 'Gagal menghapus permanen.');
        }
    }
}
