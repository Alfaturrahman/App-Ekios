<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{

    public function index()
    {
        $pengajuan = Pengajuan::with('employee')->latest()->get();

        return view('dashboard.hrd', compact('pengajuan'));
    }

    public function show($id)
    {
        $pengajuan = Pengajuan::with(['employee.department', 'employee.jabatan'])->findOrFail($id);
        $pengajuan->status = $pengajuan->status;

        return response()->json($pengajuan);
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand_type' => 'required|string',
            'nama_hp' => 'required|string',
            'os_type' => 'required|string',
            'imei1' => 'required|string',
            'imei2' => 'required|string',
            'submission_type' => 'required|string',
            'submission_reason' => 'required|string',
            'foto_depan' => 'required|image|mimes:jpeg,jpg,png',
            'foto_belakang' => 'required|image|mimes:jpeg,jpg,png',
        ]);

        // Simulasi: cari atau buat employee (harusnya based on ID, ini contoh)
        $employeeId = $request->employee_id;

        $fotoDepanPath = $request->file('foto_depan')->store('pengajuan/foto_depan', 'public');
        $fotoBelakangPath = $request->file('foto_belakang')->store('pengajuan/foto_belakang', 'public');

        Pengajuan::create([
            'employee_id' => $employeeId,
            'brand_type' => $request->brand_type,
            'nama_hp' => $request->nama_hp,
            'os_type' => $request->os_type,
            'imei1' => $request->imei1,
            'imei2' => $request->imei2,
            'submission_type' => $request->submission_type,
            'approve_HRD' => 'pending',
            'approve_QHSE' => 'pending',
            'reason_HRD' => null,
            'reason_QHSE' => null,
            'foto_depan' => $fotoDepanPath,
            'foto_belakang' => $fotoBelakangPath,
        ]);

        return response()->json(['status' => 'success']);
    }
    public function approve($id)
    {
        $user = auth('employee')->user();
        $pengajuan = Pengajuan::findOrFail($id);
        $jabatan = strtolower($user->jabatan->name);

        if ($jabatan === 'qhse') {
            $pengajuan->approve_QHSE = 'approved';
            $pengajuan->reason_QHSE = null;
        } elseif ($jabatan === 'hrd') {
            if ($pengajuan->approve_QHSE !== 'approved') {
                return response()->json(['message' => 'Belum disetujui oleh QHSE'], 403);
            }

            $pengajuan->approve_HRD = 'approved';
            $pengajuan->reason_HRD = null;
        } else {
            return response()->json(['message' => 'Tidak punya akses'], 403);
        }

        $pengajuan->save();

        return response()->json(['message' => 'Pengajuan disetujui.']);
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string'
        ]);

        $user = auth('employee')->user();
        $pengajuan = Pengajuan::findOrFail($id);
        $jabatan = strtolower($user->jabatan->name);

        if ($jabatan === 'qhse') {
            $pengajuan->approve_QHSE = 'rejected';
            $pengajuan->reason_QHSE = $request->reason;
        } elseif ($jabatan === 'hrd') {
            $pengajuan->approve_HRD = 'rejected';
            $pengajuan->reason_HRD = $request->reason;
        } else {
            return response()->json(['message' => 'Tidak punya akses'], 403);
        }

        $pengajuan->save();

        return response()->json(['message' => 'Pengajuan ditolak.']);
    }
}
