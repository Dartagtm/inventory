<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
    use App\Models\User;
use Spatie\Permission\Models\Role;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


public function run()
{
    // Membuat role jika belum ada
    $adminRole = Role::firstOrCreate(['name' => 'admin']);
    $gudangRole = Role::firstOrCreate(['name' => 'gudang_muat']);
    $suratJalanRole = Role::firstOrCreate(['name' => 'surat_jalan']);

    // Menambahkan pengguna dengan role 'admin'
    $adminUser = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => bcrypt('password')
    ]);
    $adminUser->assignRole('admin');

    // Menambahkan pengguna dengan role 'gudang_muat'
    $gudangMuatUser = User::create([
        'name' => 'Gudang Muat User',
        'email' => 'gudang@example.com',
        'password' => bcrypt('password')
    ]);
    $gudangMuatUser->assignRole('gudang_muat');

    // Menambahkan pengguna dengan role 'surat_jalan'
    $suratJalanUser = User::create([
        'name' => 'Surat Jalan User',
        'email' => 'suratjalan@example.com',
        'password' => bcrypt('password')
    ]);
    $suratJalanUser->assignRole('surat_jalan');
}

}
