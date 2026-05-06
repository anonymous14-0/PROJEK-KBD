<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\LogController; // Tambahkan ini
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// --- DASHBOARD UTAMA (LOGIKA PENGALIHAN ROLE) ---
Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($role === 'guru') {
        return redirect()->route('guru.dashboard');
    } elseif ($role === 'siswa') {
        return redirect()->route('siswa.dashboard');
    } elseif ($role === 'audit') {
        return redirect()->route('audit.dashboard');
    }

    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// --- GRUP ROUTE KHUSUS ADMIN ---
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard Admin
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // CRUD Guru
    Route::get('/admin/guru', [GuruController::class, 'index'])->name('admin.guru.index');
    Route::get('/admin/guru/create', [GuruController::class, 'create'])->name('admin.guru.create');
    Route::post('/admin/guru', [GuruController::class, 'store'])->name('admin.guru.store');

    // CRUD Siswa
    Route::resource('/admin/siswa', SiswaController::class)->names('admin.siswa');

    // --- LOG AKTIVITAS (AUDIT) ---
    // Route ini yang akan menghapus error saat kamu klik "Cek Log"
    Route::get('/admin/logs', [LogController::class, 'index'])->name('admin.logs.index');
});

// --- GRUP ROUTE KHUSUS GURU ---
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/dashboard', function () {
        return view('guru.dashboard');
    })->name('guru.dashboard');

    Route::resource('/guru/nilai', App\Http\Controllers\Guru\NilaiController::class)
        ->names('guru.nilai');
});

// --- GRUP ROUTE KHUSUS SISWA ---
Route::middleware(['auth', 'role:siswa'])->group(function () {
    // Gunakan Controller agar bisa mengambil data nilai dari database
    Route::get('/siswa/dashboard', [App\Http\Controllers\Siswa\DashboardController::class, 'index'])->name('siswa.dashboard');
});

// --- GRUP ROUTE KHUSUS AUDIT ---
Route::middleware(['auth', 'role:audit'])->group(function () {
    // Pastikan menggunakan Controller agar data Log Aktivitas bisa muncul
    Route::get('/audit/dashboard', [App\Http\Controllers\Audit\AuditController::class, 'index'])->name('audit.dashboard');
});

// --- ROUTE PROFILE ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';