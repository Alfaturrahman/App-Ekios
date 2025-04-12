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

    public function getDashboardData()
    {
        // Monthly data
        $monthly = Pengajuan::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupByRaw('MONTH(created_at)')
            ->pluck('total', 'month');

        $monthlyData = array_fill(1, 12, 0);
        foreach ($monthly as $month => $count) {
            $monthlyData[$month] = $count;
        }

        // Register Status
        $registerStatus = [
            'registered' => Pengajuan::where('approve_QHSE', 'approved')->where('approve_HRD', 'approved')->count(),
            'checking' => Pengajuan::where(function($q){
                $q->whereNull('approve_QHSE')
                ->orWhereNull('approve_HRD');
            })->count(),
            'rejected' => Pengajuan::where(function($q){
                $q->where('approve_QHSE', 'rejected')
                ->orWhere('approve_HRD', 'rejected');
            })->count(),
        ];

        // OS Devices
        $osDevices = [
            'ios' => Pengajuan::where('os_type', 'Apple')->count(),
            'android' => Pengajuan::where('os_type', 'Android')->count(),
            'unknown' => Pengajuan::whereNull('os_type')->orWhere('os_type', 'Unknown')->count(),
        ];

        return response()->json([
            'monthly' => array_values($monthlyData),
            'registerStatus' => $registerStatus,
            'osDevices' => $osDevices,
        ]);
    }
}