<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Get permission IDs
         $permissions = ['view-any','create','edit','delete'];
         $permissionIds = [];
         foreach ($permissions as $permission) {
             $permissionModel = Permission::create([
                 'name' => $permission,
                 'feature_id' => 1,
             ]);
             $permissionIds[$permission] = $permissionModel->id;
         }

         $adminRole = Role::where('name', 'admin')->first();
         $editorRole = Role::where('name', 'editor')->first();
         $viewerRole = Role::where('name', 'viewer')->first();


         $adminRole->permissions()->sync($permissionIds);

         $editorRole->permissions()->sync([$permissionIds['view-any'], $permissionIds['edit']]);

         $viewerRole->permissions()->sync([$permissionIds['view-any']]);
    }
}
