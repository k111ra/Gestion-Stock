@extends('layouts.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Paramètres / Rôles /</span> Créer un nouveau rôle
        </h4>

        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('parametres.roles.store') }}" method="POST">
                    @csrf

                    <!-- Informations de base -->
                    <div class="card mb-4">
                        <h5 class="card-header">Informations du rôle</h5>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Nom d'affichage</label>
                                    <input type="text" class="form-control @error('display_name') is-invalid @enderror"
                                        name="display_name" value="{{ old('display_name') }}" required>
                                    @error('display_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Exemple: Gestionnaire de stock</small>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Clé du rôle</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Exemple: stock_manager (sans espaces)</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Permissions -->
                    <div class="card mb-4">
                        <h5 class="card-header">Permissions du rôle</h5>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($modules as $moduleKey => $moduleName)
                                    <div class="col-md-6 mb-4">
                                        <div class="card shadow-none border">
                                            <div class="card-header bg-transparent">
                                                <div class="form-check">
                                                    <input class="form-check-input select-all-module" type="checkbox"
                                                        data-module="{{ $moduleKey }}"
                                                        id="select-all-{{ $moduleKey }}">
                                                    <label class="form-check-label fw-bold"
                                                        for="select-all-{{ $moduleKey }}">
                                                        {{ $moduleName }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex flex-wrap gap-3">
                                                    @foreach ($availablePermissions as $permKey => $permName)
                                                        <div class="form-check">
                                                            <input
                                                                class="form-check-input module-permission-{{ $moduleKey }}"
                                                                type="checkbox" name="permissions[{{ $moduleKey }}][]"
                                                                value="{{ $permKey }}"
                                                                id="{{ $moduleKey }}_{{ $permKey }}">
                                                            <label class="form-check-label"
                                                                for="{{ $moduleKey }}_{{ $permKey }}">
                                                                {{ $permName }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">Créer le rôle</button>
                        <a href="{{ route('parametres.roles.index') }}" class="btn btn-outline-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Gestionnaire pour les cases "Tout sélectionner"
                document.querySelectorAll('.select-all-module').forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        const moduleKey = this.dataset.module;
                        const modulePermissions = document.querySelectorAll(
                            `.module-permission-${moduleKey}`);
                        modulePermissions.forEach(permission => {
                            permission.checked = this.checked;
                        });
                    });
                });
            });
        </script>
    @endpush
@endsection
