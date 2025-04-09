<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'tbl_jabatan';
    protected $primaryKey = 'jabatan_id'; 
    public $incrementing = true; 
    protected $keyType = 'int'; 

    protected $fillable = ['name'];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'jabatan_id');
    }
}
