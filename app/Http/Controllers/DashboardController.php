<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;

class DashboardController extends Controller
{
    public function hrdIndex()
    {
        $pengajuan = Pengajuan::with('employee')->latest()->get();

        return view('hrd-qhse.dashboard-hrd', compact('pengajuan'));
    }
}