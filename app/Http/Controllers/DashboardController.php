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
    public function staffIndex()
    {
        $pengajuan = Pengajuan::with('employee')->latest()->get();

        return view('staff.register-staff', compact('pengajuan'));
    }
}