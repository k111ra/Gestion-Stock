@extends('layouts.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Paramètres /</span> Gestion des rôles
        </h4>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Liste des rôles</h5>
                <a href="{{ route('parametres.roles.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Nouveau rôle
                </a>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nom d'affichage</th>
                                <th>Clé</th>
                                <th>Permissions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->display_name }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            @foreach ($role->permissions as $permission)
                                                <span class="badge bg-label-primary">{{ $permission->name }}</span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('parametres.roles.edit', $role) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bx bx-edit-alt"></i>
                                            </a>
                                            @if (!in_array($role->name, ['admin', 'manager', 'user']))
                                                <form action="{{ route('parametres.roles.destroy', $role) }}" method="POST"
                                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rôle ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
