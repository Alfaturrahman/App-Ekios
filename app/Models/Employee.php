<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable // supaya bisa login pakai guard
{
    protected $table = 'tbl_employee';

    protected $primaryKey = 'employee_badge';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'employee_name',
        'employee_badge',
        'password',
        'department_id',
        'jabatan_id',
    ];

    protected $hidden = [
        'password',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'department_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'jabatan_id');
        //                                ^ foreignKey       ^ ownerKey
    }

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'employee_id');
    }

    public function username()
    {
        return 'employee_badge';
    }

}
