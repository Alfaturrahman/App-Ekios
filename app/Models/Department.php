<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'tbl_department';

    protected $fillable = ['department_name', 'department_code'];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'department_id');
    }
}
