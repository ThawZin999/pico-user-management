<?php

namespace Database\Seeders;

use App\Models\Feature;
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
        $features = [
            'User' => ['view-any', 'create', 'edit', 'delete'],
            'Role' => ['view-any', 'create', 'edit', 'delete']
        ];

        foreach ($features as $featureName => $permissions) {
            $feature = Feature::create(['name' => $featureName]);

            foreach ($permissions as $permissionName) {
                Permission::create([
                    'name' => $permissionName,
                    'feature_id' => $feature->id
                ]);
            }
        }
    }
}
