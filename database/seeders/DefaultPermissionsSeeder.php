<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DefaultPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Format des permissions : action_module (ex: view_users, create_products)
        $modules = ['users', 'products', 'stocks', 'suppliers'];
        $actions = ['view', 'create', 'edit', 'delete'];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                Permission::findOrCreate($action . '_' . $module);  // 'web' guard est utilisé par défaut
            }
        }
    }
}
