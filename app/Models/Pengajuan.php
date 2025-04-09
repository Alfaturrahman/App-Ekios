<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'tbl_pengajuan';
    protected $primaryKey = 'pengajuan_id';

    protected $fillable = [
        'employee_id',
        'brand_type',
        'nama_hp',
        'os_type',
        'imei1',
        'imei2',
        'submission_type',
        'foto_depan',
        'foto_belakang',
        'approve_HRD',
        'approve_QHSE',
        'reason_HRD',
        'reason_QHSE',
        'created_at',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    public function getStatusAttribute()
    {
        if ($this->approve_QHSE === 'rejected') return 'Ditolak QHSE';
        if ($this->approve_HRD === 'rejected') return 'Ditolak HRD';
        if (is_null($this->approve_QHSE)) return 'Menunggu QHSE';
        if ($this->approve_QHSE === 'approved' && is_null($this->approve_HRD)) return 'Menunggu HRD';
        if ($this->approve_QHSE === 'approved' && $this->approve_HRD === 'approved') return 'Disetujui';
        return 'Tidak diketahui';
    }
}
