<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AktivitasLog;

class LogController extends Controller
{
    public function index()
    {
        // Mengambil log terbaru dan memuat data user yang bersangkutan
        $logs = AktivitasLog::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.audit.index', compact('logs'));
    }
}
