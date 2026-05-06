<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Public self-registration is intentionally disabled for this academic system.
     */
    public function create(): View
    {
        abort(404);
    }

    /**
     * Public self-registration is intentionally disabled for this academic system.
     */
    public function store(Request $request): RedirectResponse
    {
        abort(404);
    }
}
