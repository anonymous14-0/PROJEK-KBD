<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Hapus validasi 'unique:users' pada email
        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Cek Unique Email Manual (Enkripsi dulu baru cek ke DB)
        $encryptedEmail = User::encryptData($request->email);
        if (User::where('email', $encryptedEmail)->exists()) {
            throw ValidationException::withMessages([
                'email' => 'Email sudah digunakan.',
            ]);
        }

        // 3. Simpan ke database sesuai struktur tabel SIAKAD kamu
        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email, // Otomatis terenkripsi oleh mutator di model User
            'password' => Hash::make($request->password),
            'role' => 'siswa', // Default role saat mendaftar mandiri
            'is_active' => true,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
