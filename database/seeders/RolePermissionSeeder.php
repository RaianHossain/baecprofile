<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Example permissions (you can expand these as needed)
        $permissions = [
            'manage researchers',
            'view dashboard',
            'edit own profile',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $researcher = Role::firstOrCreate(['name' => 'researcher']);

        // Assign permissions to roles
        $superAdmin->givePermissionTo(Permission::all());

        $researcher->givePermissionTo([
            'edit own profile',
            'view dashboard',
        ]);
    }
}
// This seeder creates two roles: super_admin and researcher.
// It assigns all permissions to the super_admin role and specific permissions to the researcher role.
// You can run this seeder using the command:
// php artisan db:seed --class=RolePermissionSeeder
// This will populate your database with the roles and permissions defined in the seeder.