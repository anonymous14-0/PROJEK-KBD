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
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $gurus = Guru::orderBy('nama_lengkap')->paginate(50);
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

        $validated = $request->validate([
            'nip' => ['required', 'string', 'max:50', 'unique:guru,nip'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
        ]);

        if (User::where('email', $email)->exists()) {
            throw ValidationException::withMessages([
                'nip' => 'Email akun guru otomatis sudah digunakan.',
            ]);
        }

        $initialPassword = Str::password(32);

        try {
            $guru = DB::transaction(function () use ($validated, $email, $initialPassword) {
                $guru = Guru::create($validated);

                User::create([
                    'nama_lengkap' => $validated['nama_lengkap'],
                    'email' => $email,
                    'password' => Hash::make($initialPassword),
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

        $resetStatus = Password::sendResetLink(['email' => $email]);

        Log::info('Link reset password akun baru diproses', [
            'email' => $email,
            'status' => $resetStatus,
            'created_by' => $request->user()?->getKey(),
        ]);

        AuditTrail::record("Admin menambahkan guru ID {$guru->id_guru}", $request);

        return redirect()->route('admin.guru.index')->with([
            'success' => 'Guru & Akun Login berhasil dibuat. Link reset password sudah dikirim bila email dapat menerima notifikasi. User juga dapat memakai fitur lupa password.',
            'account_email' => $email,
        ]);
    }
}
