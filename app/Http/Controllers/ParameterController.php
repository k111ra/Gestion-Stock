<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ParameterController extends Controller
{
    public function index()
    {
        return view('parametres.index');
    }

    public function roles()
    {
        $roles = [
            'admin' => [
                'name' => 'Administrateur',
                'permissions' => [
                    'users' => ['create', 'read', 'update', 'delete'],
                    'products' => ['create', 'read', 'update', 'delete'],
                    'stock' => ['create', 'read', 'update', 'delete'],
                    'suppliers' => ['create', 'read', 'update', 'delete'],
                ]
            ],
            'manager' => [
                'name' => 'Gestionnaire',
                'permissions' => [
                    'products' => ['read'],
                    'stock' => ['read', 'create'],
                    'suppliers' => ['read'],
                ]
            ],
            'user' => [
                'name' => 'Utilisateur',
                'permissions' => [
                    'products' => ['read'],
                    'stock' => ['read'],
                ]
            ]
        ];

        return view('parametres.roles', compact('roles'));
    }

    public function updateRolePermissions(Request $request)
    {
        // Logique pour mettre à jour les permissions
        return redirect()->back()->with('success', 'Permissions mises à jour avec succès');
    }

    public function createRole()
    {
        $modules = [
            'users' => 'Utilisateurs',
            'products' => 'Produits',
            'stock' => 'Stock',
            'suppliers' => 'Fournisseurs',
        ];

        $availablePermissions = [
            'create' => 'Créer',
            'read' => 'Lire',
            'update' => 'Modifier',
            'delete' => 'Supprimer'
        ];

        return view('parametres.create-role', compact('modules', 'availablePermissions'));
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:50',
            'role_key' => 'required|string|max:20|unique:roles,name',
            'permissions' => 'required|array'
        ]);

        // Logique pour sauvegarder le nouveau rôle
        return redirect()->route('parametres.roles')
            ->with('success', 'Nouveau rôle créé avec succès');
    }
}
