<?php

// Controller untuk menampilkan form login, memproses login, dan logout.
use App\Http\Controllers\Auth\AuthenticatedSessionController;
// Controller untuk konfirmasi ulang password pada area sensitif.
use App\Http\Controllers\Auth\ConfirmablePasswordController;
// Controller untuk mengirim ulang notifikasi verifikasi email.
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
// Controller invokable untuk menampilkan instruksi verifikasi email.
use App\Http\Controllers\Auth\EmailVerificationPromptController;
// Controller untuk menampilkan dan memproses reset password baru.
use App\Http\Controllers\Auth\NewPasswordController;
// Controller untuk memperbarui password pengguna yang sudah login.
use App\Http\Controllers\Auth\PasswordController;
// Controller untuk permintaan tautan reset password jika fitur diaktifkan.
use App\Http\Controllers\Auth\PasswordResetLinkController;
// Controller untuk registrasi akun jika fitur pendaftaran diaktifkan.
use App\Http\Controllers\Auth\RegisteredUserController;
// Controller untuk memverifikasi email melalui tautan bertanda tangan.
use App\Http\Controllers\Auth\VerifyEmailController;
// Facade Route digunakan untuk mendefinisikan URL dan middleware autentikasi.
use Illuminate\Support\Facades\Route;

// Grup route guest hanya dapat diakses oleh pengguna yang belum login.
Route::middleware('guest')->group(function () {
    //Route::get('register', [RegisteredUserController::class, 'create'])
    //    ->name('register');

    //Route::post('register', [RegisteredUserController::class, 'store']);

    // Menampilkan halaman login.
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    // Memproses data login yang dikirim dari form.
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    //     ->name('password.request');

    // Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    //     ->middleware('throttle:3,1')
    //     ->name('password.email');

    // Menampilkan form reset password berdasarkan token.
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    // Menyimpan password baru setelah token dan input tervalidasi.
    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

// Keamanan: route akun yang memerlukan login dibatasi ke role aplikasi yang valid.
Route::middleware(['auth', 'role:admin,guru,siswa,audit'])->group(function () {
    // Menampilkan halaman pemberitahuan bahwa email perlu diverifikasi.
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    // Memproses klik tautan verifikasi email yang dilindungi middleware signed dan throttle.
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    // Mengirim ulang email verifikasi dengan pembatasan jumlah request.
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // Menampilkan form konfirmasi password.
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    // Memvalidasi password yang diketik ulang pengguna.
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Memperbarui password user yang sedang login.
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // Memproses logout dan mengakhiri sesi pengguna.
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
