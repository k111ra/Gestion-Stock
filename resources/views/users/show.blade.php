@extends('layouts.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Utilisateurs /</span> Détails de l'utilisateur
        </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Informations de l'utilisateur</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nom</label>
                                <p class="form-control-static">{{ $user->name }}</p>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Email</label>
                                <p class="form-control-static">{{ $user->email }}</p>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Rôle</label>
                                <p class="form-control-static">
                                    <span class="badge bg-label-primary">{{ $user->role }}</span>
                                </p>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Date d'inscription</label>
                                <p class="form-control-static">{{ $user->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary me-2">Modifier</a>
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Retour</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
