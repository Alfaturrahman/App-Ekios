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

    public function getDashboardData(Request $request)
    {
        $year = $request->input('year', date('Y')); // default: tahun sekarang
        $departmentId = $request->input('department'); // bisa null

        // Base query with filters
        $baseQuery = Pengajuan::with('employee')
            ->whereYear('created_at', $year);

        if ($departmentId) {
            $baseQuery->whereHas('employee', function ($q) use ($departmentId) {
                $q->where('department_id', $departmentId);
            });
        }

        // Monthly data
        $monthly = (clone $baseQuery)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupByRaw('MONTH(created_at)')
            ->pluck('total', 'month');

        $monthlyData = array_fill(1, 12, 0);
        foreach ($monthly as $month => $count) {
            $monthlyData[$month] = $count;
        }

        // Register Status
        $registerStatus = [
            'registered' => (clone $baseQuery)->where('approve_QHSE', 'approved')->where('approve_HRD', 'approved')->count(),
            'checking' => (clone $baseQuery)->where(function($q){
                $q->whereNull('approve_QHSE')
                ->orWhereNull('approve_HRD');
            })->count(),
            'rejected' => (clone $baseQuery)->where(function($q){
                $q->where('approve_QHSE', 'rejected')
                ->orWhere('approve_HRD', 'rejected');
            })->count(),
        ];

        // OS Devices
        $osDevices = [
            'ios' => (clone $baseQuery)->where('os_type', 'Apple')->count(),
            'android' => (clone $baseQuery)->where('os_type', 'Android')->count(),
            'unknown' => (clone $baseQuery)->whereNull('os_type')->orWhere('os_type', 'Unknown')->count(),
        ];

        return response()->json([
            'monthly' => array_values($monthlyData),
            'registerStatus' => $registerStatus,
            'osDevices' => $osDevices,
        ]);
    }
}