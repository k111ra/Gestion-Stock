@extends('layouts.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Utilisateurs /</span> Ajouter un utilisateur
        </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Détails du nouvel utilisateur</h5>
                    <div class="card-body">
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Nom</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Mot de passe</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Rôle</label>
                                    <select name="role" class="form-select" required>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Enregistrer</button>
                                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Annuler</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
