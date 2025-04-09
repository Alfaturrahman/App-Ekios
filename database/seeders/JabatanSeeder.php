<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        Jabatan::create(['name' => 'Staff']);
        Jabatan::create(['name' => 'HRD']);
        Jabatan::create(['name' => 'QHSE']);
    }
}
