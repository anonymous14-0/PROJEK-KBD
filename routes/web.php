<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\LogController;
use Illuminate\Support\Facades\Route;

// Halaman Awal
Route::get('/', function () {
    return view('welcome');
});

// --- DASHBOARD UTAMA (LOGIKA PENGALIHAN ROLE) ---
// Keamanan: route dashboard dilindungi auth + role agar hanya user berotorisasi yang dapat masuk.
Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    // Otomatis mengarahkan user sesuai role masing-masing
    if ($role === 'admin') return redirect()->route('admin.dashboard');
    elseif ($role === 'guru') return redirect()->route('guru.dashboard');
    elseif ($role === 'siswa') return redirect()->route('siswa.dashboard');
    elseif ($role === 'audit') return redirect()->route('audit.dashboard');

    return view('dashboard');
})->middleware(['auth', 'verified', 'role:admin,guru,siswa,audit'])->name('dashboard');

// --- GRUP ROUTE KHUSUS ADMIN ---
// Keamanan: middleware role menjaga agar hanya User Login ber-role 'admin' yang bisa mengakses.
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // ==========================================
    // RUTE SOFT DELETES
    // WAJIB diletakkan di atas rute index/resource agar URL '/trashed'
    // tidak terbaca sebagai parameter {id} oleh rute lain.
    // ==========================================

    // Tempat Sampah Guru
    Route::get('/admin/guru/trashed', [GuruController::class, 'trashed'])->name('admin.guru.trashed');
    Route::post('/admin/guru/{id}/restore', [GuruController::class, 'restore'])->name('admin.guru.restore');
    Route::delete('/admin/guru/{id}/force-delete', [GuruController::class, 'forceDelete'])->name('admin.guru.force_delete');

    // Tempat Sampah Siswa
    Route::get('/admin/siswa/trashed', [SiswaController::class, 'trashed'])->name('admin.siswa.trashed');
    Route::post('/admin/siswa/{id}/restore', [SiswaController::class, 'restore'])->name('admin.siswa.restore');
    Route::delete('/admin/siswa/{id}/force-delete', [SiswaController::class, 'forceDelete'])->name('admin.siswa.force_delete');

    // ==========================================
    // CRUD DATA GURU & SISWA
    // ==========================================
    Route::get('/admin/guru', [GuruController::class, 'index'])->name('admin.guru.index');
    Route::get('/admin/guru/create', [GuruController::class, 'create'])->name('admin.guru.create');
    Route::post('/admin/guru', [GuruController::class, 'store'])->name('admin.guru.store');
    Route::get('/admin/guru/{guru}/edit', [GuruController::class, 'edit'])->name('admin.guru.edit');
    Route::put('/admin/guru/{guru}', [GuruController::class, 'update'])->name('admin.guru.update');
    Route::delete('/admin/guru/{guru}', [GuruController::class, 'destroy'])->name('admin.guru.destroy');

    // Route Resource otomatis mendaftarkan semua method CRUD (index, create, store, edit, update, destroy)
    Route::resource('/admin/siswa', SiswaController::class)->names('admin.siswa');

    // --- LOG AKTIVITAS (AUDIT) ---
    Route::get('/admin/logs', [LogController::class, 'index'])->name('admin.logs.index');
});

// --- GRUP ROUTE KHUSUS GURU ---
// Keamanan: halaman guru dilindungi auth + role:guru.
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/dashboard', function () {
        return view('guru.dashboard');
    })->name('guru.dashboard');
    Route::resource('/guru/nilai', App\Http\Controllers\Guru\NilaiController::class)->names('guru.nilai');
});

// --- GRUP ROUTE KHUSUS SISWA ---
// Keamanan: halaman siswa dilindungi auth + role:siswa.
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswa/dashboard', [App\Http\Controllers\Siswa\DashboardController::class, 'index'])->name('siswa.dashboard');
});

// --- GRUP ROUTE KHUSUS AUDIT ---
// Keamanan: halaman audit dilindungi auth + role:audit.
Route::middleware(['auth', 'role:audit'])->group(function () {
    Route::get('/audit/dashboard', [App\Http\Controllers\Audit\AuditController::class, 'index'])->name('audit.dashboard');
});

// --- ROUTE PROFILE BAWAAN LARAVEL ---
// Keamanan: profil memerlukan auth dan role valid, bukan hanya session anonim.
Route::middleware(['auth', 'role:admin,guru,siswa,audit'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
