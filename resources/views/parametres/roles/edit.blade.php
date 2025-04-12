@extends('layouts.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Paramètres / Rôles /</span> Modifier un rôle
        </h4>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Modifier le rôle</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('parametres.roles.update', $role) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nom du rôle</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $role->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="display_name" class="form-label">Nom d'affichage</label>
                        <input type="text" class="form-control @error('display_name') is-invalid @enderror"
                            id="display_name" name="display_name" value="{{ old('display_name', $role->display_name) }}"
                            required>
                        @error('display_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        @php
                            $modules = [
                                'users' => 'Utilisateurs',
                                'products' => 'Produits',
                                'stocks' => 'Stocks',
                                'suppliers' => 'Fournisseurs',
                            ];
                            $availablePermissions = [
                                'view' => 'Voir',
                                'create' => 'Créer',
                                'edit' => 'Modifier',
                                'delete' => 'Supprimer',
                            ];
                        @endphp

                        @foreach ($modules as $moduleKey => $moduleName)
                            <div class="card mb-2">
                                <div class="card-body">
                                    <h6>{{ $moduleName }}</h6>
                                    <div class="d-flex gap-3">
                                        @foreach ($availablePermissions as $permKey => $permName)
                                            @php
                                                // Permission format: action_module (e.g. view_users)
                                                $permissionName = $permKey . '_' . $moduleKey;
                                            @endphp
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    name="permissions[{{ $moduleKey }}][]" value="{{ $permKey }}"
                                                    id="{{ $permissionName }}"
                                                    {{ $role->hasPermissionTo($permissionName) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="{{ $permissionName }}">{{ $permName }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('parametres.roles.index') }}" class="btn btn-secondary">Retour</a>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
