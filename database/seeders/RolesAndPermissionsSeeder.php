<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions
        $createDish = Permission::firstOrCreate(['name' => 'create dishes']);
        $deleteDish = Permission::firstOrCreate(['name' => 'delete dishes']);
        $updateDish = Permission::firstOrCreate(['name' => 'update dishes']);
        $viewDish   = Permission::firstOrCreate(['name' => 'view dishes']);
        
        // Role Admin
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo([
            $createDish,
            $deleteDish,
            $viewDish,
            $updateDish,
        ]);

        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->givePermissionTo([$viewDish]);
    }
}
