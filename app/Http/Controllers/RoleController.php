<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('parametres.roles.index', compact('roles'));
    }

    public function create()
    {
        $modules = [
            'users' => 'Utilisateurs',
            'products' => 'Produits',
            'stocks' => 'Stocks',
            'suppliers' => 'Fournisseurs'
        ];

        $availablePermissions = [
            'view' => 'Voir',
            'create' => 'Créer',
            'edit' => 'Modifier',
            'delete' => 'Supprimer'
        ];

        return view('parametres.roles.create', compact('modules', 'availablePermissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'display_name' => 'required|string|max:255',
            'permissions' => 'required|array'
        ]);

        $role = Role::create([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);

        $permissions = [];
        foreach ($request->permissions as $module => $actions) {
            foreach ($actions as $action) {
                $permissionName = $action . '_' . $module;
                if (!Permission::where('name', $permissionName)->exists()) {
                    Permission::create(['name' => $permissionName, 'guard_name' => 'web']);
                }
                $permissions[] = $permissionName;
            }
        }

        $role->syncPermissions($permissions);

        return redirect()->route('parametres.roles.index')
            ->with('success', 'Rôle créé avec succès.');
    }

    public function edit(Role $role)
    {
        $modules = [
            'users' => 'Utilisateurs',
            'products' => 'Produits',
            'stocks' => 'Stocks',
            'suppliers' => 'Fournisseurs'
        ];

        $availablePermissions = [
            'view' => 'Voir',
            'create' => 'Créer',
            'edit' => 'Modifier',
            'delete' => 'Supprimer'
        ];

        return view('parametres.roles.edit', compact('role', 'modules', 'availablePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'display_name' => 'required|string|max:255',
            'permissions' => 'required|array'
        ]);

        $role->update([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);

        $permissions = [];
        foreach ($request->permissions as $module => $actions) {
            foreach ($actions as $action) {
                $permissionName = $action . '_' . $module;
                if (!Permission::where('name', $permissionName)->exists()) {
                    Permission::create(['name' => $permissionName, 'guard_name' => 'web']);
                }
                $permissions[] = $permissionName;
            }
        }

        $role->syncPermissions($permissions);

        return redirect()->route('parametres.roles.index')
            ->with('success', 'Rôle mis à jour avec succès.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('parametres.roles.index')
            ->with('success', 'Rôle supprimé avec succès.');
    }
}
