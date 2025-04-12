@extends('layouts.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Utilisateurs /</span> Modifier l'utilisateur
        </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Modifier les informations</h5>
                    <div class="card-body">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Nom</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                                        required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                                        required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Nouveau mot de passe</label>
                                    <input type="password" name="password" class="form-control">
                                    <small class="text-muted">Laissez vide pour conserver le mot de passe actuel</small>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Rôle</label>
                                    <select name="role" class="form-select" required>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}"
                                                {{ $user->role === $role->name ? 'selected' : '' }}>
                                                {{ $role->display_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Mettre à jour</button>
                                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Annuler</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
