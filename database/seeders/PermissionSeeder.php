<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $modules = ['users', 'products', 'stocks', 'suppliers'];
        $actions = ['view', 'create', 'edit', 'delete'];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                Permission::create([
                    'name' => $action . '_' . $module,
                    'guard_name' => 'web'
                ]);
            }
        }
    }
}
