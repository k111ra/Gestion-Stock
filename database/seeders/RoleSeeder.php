<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'display_name' => 'Administrateur',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'manager',
            'display_name' => 'Gestionnaire',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'user',
            'display_name' => 'Utilisateur',
            'guard_name' => 'web'
        ]);
    }
}
