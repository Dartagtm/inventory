<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    

public function run()
{
    // Membuat role
    Role::create(['name' => 'admin']);
    Role::create(['name' => 'gudang_muat']);
    Role::create(['name' => 'surat_jalan']);
}

}
