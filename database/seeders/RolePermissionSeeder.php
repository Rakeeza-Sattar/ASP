<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User management
            'view users',
            'create users',
            'edit users',
            'delete users',
            
            // Appointment management
            'view appointments',
            'create appointments',
            'edit appointments',
            'delete appointments',
            'assign officers',
            
            // Item documentation
            'view items',
            'create items',
            'edit items',
            'delete items',
            'upload files',
            
            // Report management
            'view reports',
            'generate reports',
            'sign reports',
            
            // Payment management
            'view payments',
            'process payments',
            
            // Title monitoring
            'view title monitoring',
            'manage title monitoring',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $officerRole = Role::create(['name' => 'officer']);
        $officerRole->givePermissionTo([
            'view appointments',
            'edit appointments',
            'view items',
            'create items',
            'edit items',
            'upload files',
            'generate reports',
            'sign reports',
        ]);

        $homeownerRole = Role::create(['name' => 'homeowner']);
        $homeownerRole->givePermissionTo([
            'view appointments',
            'create appointments',
            'view items',
            'view reports',
            'sign reports',
            'view payments',
            'process payments',
            'view title monitoring',
        ]);
    }
}