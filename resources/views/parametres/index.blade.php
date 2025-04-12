@extends('layouts.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Paramètres du système</h4>

        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="card mb-4">
                    <h5 class="card-header">Gestion des rôles</h5>
                    <div class="card-body">
                        <p>Gérez les permissions pour chaque rôle utilisateur</p>
                        <a href="{{ route('parametres.roles.index') }}" class="btn btn-primary">
                            <i class="bx bx-key me-1"></i>
                            Gérer les rôles
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
