<?php

namespace Database\Seeders;

 use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        Employee::create([
            'employee_name' => 'Admin HRD',
            'employee_badge' => '123456',
            'password' => Hash::make('password'), // default login password
            'department_id' => 1,
            'jabatan_id' => 1,
        ]);
    }
}
