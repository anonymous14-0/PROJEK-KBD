<?php

namespace App\Http\Controllers\Audit;

use App\Http\Controllers\Controller;
use App\Models\AktivitasLog;
use App\Services\AuditTrail;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function index(Request $request)
    {
        AuditTrail::record('Petugas audit melihat log aktivitas', $request);

        // Mengambil semua log, diurutkan dari yang terbaru
        $logs = AktivitasLog::with('user')->latest()->paginate(50);

        return view('audit.dashboard', compact('logs'));
    }
}