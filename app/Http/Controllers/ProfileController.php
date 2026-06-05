<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\AuditTrail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();
        $before = [
            'nama_lengkap' => $user->nama_lengkap,
            'email' => $user->email,
        ];
        $after = [
            'nama_lengkap' => $validated['nama_lengkap'] ?? $user->nama_lengkap,
            'email' => $validated['email'] ?? $user->email,
        ];

        $user->fill($validated);
        $user->save();

        $detailPerubahan = AuditTrail::describeChanges($before, $after, [
            'nama_lengkap' => 'Nama lengkap',
            'email' => 'Email akun',
        ]);

        AuditTrail::record("User memperbarui profil. {$detailPerubahan}", $request);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        AuditTrail::record('User mencoba menghapus akun sendiri dan ditolak', $request);

        abort(403, 'Penghapusan akun mandiri dinonaktifkan. Hubungi administrator.');
    }
}
