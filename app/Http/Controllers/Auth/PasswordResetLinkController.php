<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Enkripsi email sebelum mengirim ke broker password
        $encryptedEmail = User::encryptData($request->input('email'));

        // Kirim array dengan email yang terenkripsi
        $status = Password::sendResetLink([
            'email' => $encryptedEmail
        ]);

        Log::info('Permintaan reset password', [
            'email' => $request->input('email'), // Log tetap mencatat plaintext untuk kemudahan debugging
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => $status,
        ]);

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
    }
}
