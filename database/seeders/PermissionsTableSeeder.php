<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        // Créer les permissions
        $permissions = [
            'users_read',
            'users_create',
            'users_update',
            'users_delete',
            'products_read',
            'products_create',
            'products_update',
            'products_delete',
            'settings_access'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Créer le rôle admin
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo($permissions);
    }
}
