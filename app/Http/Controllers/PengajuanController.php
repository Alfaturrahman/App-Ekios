<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Employee;
use App\Models\PengajuanHistory;
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
        $pengajuan = Pengajuan::with(['employee.department', 'employee.jabatan', 'histories'])->findOrFail($id);

        // Mapping status gabungan
        if ($pengajuan->approve_QHSE === 'pending') {
            $status = 'Menunggu QHSE';
        } elseif ($pengajuan->approve_QHSE === 'approved' && $pengajuan->approve_HRD === 'pending') {
            $status = 'Menunggu HRD';
        } elseif ($pengajuan->approve_QHSE === 'approved' && $pengajuan->approve_HRD === 'approved') {
            $status = 'Disetujui';
        } elseif ($pengajuan->approve_QHSE === 'rejected') {
            $status = 'Ditolak QHSE';
        } elseif ($pengajuan->approve_HRD === 'rejected') {
            $status = 'Ditolak HRD';
        } else {
            $status = 'Status tidak diketahui';
        }

        $pengajuan->status = $status;

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

        $user = auth('employee')->user();
        $employeeId = $request->employee_id ?? $user->employee_id;

        $fotoDepanPath = $request->file('foto_depan')->store('pengajuan/foto_depan', 'public');
        $fotoBelakangPath = $request->file('foto_belakang')->store('pengajuan/foto_belakang', 'public');

        $pengajuan = Pengajuan::create([
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

        PengajuanHistory::create([
            'pengajuan_id' => $pengajuan->pengajuan_id,
            'status' => 'Created Submission',
            'note' => $request->submission_reason,
            'by_name' => $user->employee_name,
            'user_badge' => $user->employee_badge,
            'robadge' => strtolower($user->jabatan->name ?? 'employee'),
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

            PengajuanHistory::create([
                'pengajuan_id' => $pengajuan->pengajuan_id,
                'status' => 'Approved by QHSE',
                'note' => null,
                'by_name' => $user->employee_name,
                'user_badge' => $user->employee_badge,
                'role' => $jabatan,
            ]);
        } elseif ($jabatan === 'hrd') {
            if ($pengajuan->approve_QHSE !== 'approved') {
                return response()->json(['message' => 'Belum disetujui oleh QHSE'], 403);
            }

            $pengajuan->approve_HRD = 'approved';
            $pengajuan->reason_HRD = null;

            PengajuanHistory::create([
                'pengajuan_id' => $pengajuan->pengajuan_id,
                'status' => 'Approved by HRD',
                'note' => null,
                'by_name' => $user->employee_name,
                'user_badge' => $user->employee_badge,
                'role' => $jabatan,
            ]);
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

            PengajuanHistory::create([
                'pengajuan_id' => $pengajuan->pengajuan_id,
                'status' => 'Rejected by QHSE',
                'note' => $request->reason,
                'by_name' => $user->employee_name,
                'user_badge' => $user->employee_badge,
                'role' => $jabatan,
            ]);
        } elseif ($jabatan === 'hrd') {
            $pengajuan->approve_HRD = 'rejected';
            $pengajuan->reason_HRD = $request->reason;

            PengajuanHistory::create([
                'pengajuan_id' => $pengajuan->pengajuan_id,
                'status' => 'Rejected by HRD',
                'note' => $request->reason,
                'by_name' => $user->employee_name,
                'user_badge' => $user->employee_badge,
                'role' => $jabatan,
            ]);
        } else {
            return response()->json(['message' => 'Tidak punya akses'], 403);
        }

        $pengajuan->save();

        return response()->json(['message' => 'Pengajuan ditolak.']);
    }
}
