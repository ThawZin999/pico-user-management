<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminId = Role::where('name', 'admin')->first()->id;

        User::create([
            'name' => 'adminone',
            'username' => 'Admin One',
            'role_id' => $adminId,
            'phone' => '0912345678',
            'email' => 'adminone@gmail.com',
            'address' => 'Address One',
            'password' => bcrypt('password'),
            'gender' => true,
            'is_active' => true
        ]);


        $editorId = Role::where('name', 'editor')->first()->id;

        User::create([
            'name' => 'editorone',
            'username' => 'Editor One',
            'role_id' => $editorId,
            'phone' => '09123335678',
            'email' => 'editorone@gmail.com',
            'address' => 'Address One',
            'password' => bcrypt('password'),
            'gender' => false,
            'is_active' => true
        ]);

        $viewerId = Role::where('name', 'viewer')->first()->id;
        User::create([
            'name' => 'viewerone',
            'username' => 'Viewer One',
            'role_id' => $viewerId,
            'phone' => '09123335679',
            'email' => 'viewerone@gmail.com',
            'address' => 'Address One',
            'password' => bcrypt('password'),
            'gender' => true,
            'is_active' => true
        ]);
    }
}
