<?php

namespace App\Http\Controllers\Audit;

use App\Http\Controllers\Controller;
use App\Models\AktivitasLog;

class AuditController extends Controller
{
    public function index()
    {
        // Mengambil semua log, diurutkan dari yang terbaru
        $logs = AktivitasLog::with('user')->latest()->get();

        return view('audit.dashboard', compact('logs'));
    }
}