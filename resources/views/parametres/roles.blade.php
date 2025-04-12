@extends('layouts.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0">
                <span class="text-muted fw-light">Paramètres /</span> Gestion des rôles
            </h4>
            <a href="{{ route('parametres.roles.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i>
                Créer un nouveau rôle
            </a>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Permissions par rôle</h5>
                    <div class="card-body">
                        <form action="{{ route('parametres.roles.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            @foreach ($roles as $roleKey => $role)
                                <div class="mb-4">
                                    <h6 class="fw-bold">{{ $role['name'] }}</h6>
                                    <div class="mt-3">
                                        @foreach ($role['permissions'] as $module => $permissions)
                                            <div class="mb-3">
                                                <label class="form-label text-capitalize">{{ $module }}</label>
                                                <div class="d-flex gap-3">
                                                    @foreach ($permissions as $permission)
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="permissions[{{ $roleKey }}][{{ $module }}][]"
                                                                value="{{ $permission }}" checked
                                                                id="{{ $roleKey }}_{{ $module }}_{{ $permission }}">
                                                            <label class="form-check-label text-capitalize"
                                                                for="{{ $roleKey }}_{{ $module }}_{{ $permission }}">
                                                                {{ $permission }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2">Enregistrer les modifications</button>
                                <a href="{{ route('parametres.index') }}" class="btn btn-outline-secondary">Retour</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
