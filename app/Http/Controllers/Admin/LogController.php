<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AktivitasLog;
use App\Services\AuditTrail;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(Request $request)
    {
        AuditTrail::record('Admin melihat log aktivitas', $request);

        // Mengambil log terbaru dan memuat data user yang bersangkutan
        $logs = AktivitasLog::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.audit.index', compact('logs'));
    }
}
