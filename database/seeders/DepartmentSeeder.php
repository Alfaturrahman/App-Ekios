<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        Department::create(['department_name' => 'HRD', 'department_code' => 'D001']);
        Department::create(['department_name' => 'IT', 'department_code' => 'D002']);
    }
}
