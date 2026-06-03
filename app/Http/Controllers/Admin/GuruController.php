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
        $email = $request->input('nip').'@siakad.com';

        // Pengecekan unique bawaan dihapus karena data di DB tersimpan sebagai ciphertext
        $validated = $request->validate([
            'nip' => ['required', 'string', 'max:50'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
        ]);

        // Cek Unique Manual untuk NIP (Enkripsi dulu nilainya baru dicek ke DB)
        $encryptedNip = Guru::encryptData($request->input('nip'));
        if (Guru::where('nip', $encryptedNip)->exists()) {
            throw ValidationException::withMessages([
                'nip' => 'NIP sudah digunakan.',
            ]);
        }

        // Cek Unique Manual untuk Email Akun
        $encryptedEmail = User::encryptData($email);
        if (User::where('email', $encryptedEmail)->exists()) {
            throw ValidationException::withMessages([
                'nip' => 'Email akun guru otomatis sudah digunakan.',
            ]);
        }

        $temporaryPassword = Str::password(16);

        try {
            $guru = DB::transaction(function () use ($validated, $email, $temporaryPassword) {
                $guru = Guru::create($validated);

                User::create([
                    'nama_lengkap' => $validated['nama_lengkap'],
                    'email' => $email, // Akan otomatis dienkripsi oleh model
                    'password' => Hash::make($temporaryPassword),
                    'role' => 'guru',
                    'id_guru' => $guru->id_guru,
                    'is_active' => true,
                    'must_change_password' => true,
                ]);

                return $guru;
            });
        } catch (\Throwable $e) {
            Log::error('Gagal membuat guru dan akun login', [
                'nip' => $request->input('nip'),
                'ip_address' => $request->ip(),
                'exception' => $e,
            ]);

            return back()->withInput()->with('error', 'Gagal menyimpan data guru. Silakan coba lagi.');
        }

        AuditTrail::record("Admin menambahkan guru ID {$guru->id_guru}", $request);

        return redirect()->route('admin.guru.index')->with([
            'success' => 'Guru & Akun Login berhasil dibuat. Berikan password sementara ini kepada guru dan minta segera diganti.',
            'temporary_password' => $temporaryPassword,
            'temporary_account_email' => $email, // Tampilkan balikan tetap plaintext
        ]);
    }

    public function edit(Request $request, Guru $guru)
    {
        AuditTrail::record("Admin membuka form edit guru ID {$guru->id_guru}", $request);

        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $validated = $request->validate([
            'nip' => ['required', 'string', 'max:50'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
        ]);

        $encryptedNip = Guru::encryptData($validated['nip']);
        if (Guru::where('nip', $encryptedNip)->whereKeyNot($guru->id_guru)->exists()) {
            throw ValidationException::withMessages([
                'nip' => 'NIP sudah digunakan.',
            ]);
        }

        $newEmail = $validated['nip'].'@siakad.com';
        $encryptedEmail = User::encryptData($newEmail);
        $currentUser = $guru->user;

        if (User::where('email', $encryptedEmail)
            ->when($currentUser, fn ($query) => $query->whereKeyNot($currentUser->id_user))
            ->exists()) {
            throw ValidationException::withMessages([
                'nip' => 'Email akun guru otomatis sudah digunakan.',
            ]);
        }

        $oldNip = $guru->nip;
        $oldName = $guru->nama_lengkap;

        try {
            DB::transaction(function () use ($guru, $validated, $newEmail, $currentUser) {
                $guru->update($validated);

                if ($currentUser) {
                    $currentUser->update([
                        'nama_lengkap' => $validated['nama_lengkap'],
                        'email' => $newEmail,
                    ]);
                }
            });
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui guru dan akun login', [
                'id_guru' => $guru->id_guru,
                'nip' => $request->input('nip'),
                'ip_address' => $request->ip(),
                'exception' => $e,
            ]);

            return back()->withInput()->with('error', 'Gagal memperbarui data guru. Silakan coba lagi.');
        }

        AuditTrail::record(
            "Admin mengedit guru ID {$guru->id_guru} dari NIP {$oldNip} / {$oldName} menjadi NIP {$validated['nip']} / {$validated['nama_lengkap']}",
            $request
        );

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Request $request, Guru $guru)
    {
        $guruId = $guru->id_guru;
        $nip = $guru->nip;
        $name = $guru->nama_lengkap;

        try {
            DB::transaction(function () use ($guru) {
                $guru->delete();
            });
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus guru dan akun login', [
                'id_guru' => $guruId,
                'nip' => $nip,
                'ip_address' => $request->ip(),
                'exception' => $e,
            ]);

            return back()->with('error', 'Gagal menghapus data guru. Silakan coba lagi.');
        }

        AuditTrail::record("Admin menghapus guru ID {$guruId} dengan NIP {$nip} / {$name}", $request);

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
