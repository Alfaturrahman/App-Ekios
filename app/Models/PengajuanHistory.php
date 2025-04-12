<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanHistory extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'pengajuan_id',
        'status',
        'note',
        'by_name',
        'user_badge',
        'role',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($history) {
            if (auth('employee')->check()) {
                $user = auth('employee')->user();
                $history->created_by = $user->employee_id;
                $history->updated_by = $user->employee_id;
            }
        });

        static::updating(function ($history) {
            if (auth('employee')->check()) {
                $history->updated_by = auth('employee')->user()->employee_id;
            }
        });
    }

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }
}
