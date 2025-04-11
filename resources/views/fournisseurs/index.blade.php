@extends('layouts.layout')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Fournisseurs Card -->
        <div class="card">
            <h5 class="card-header">Liste des Fournisseurs</h5>
            <div class="card-body">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFournisseurModal">
                    Ajouter Fournisseur
                </button>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Adresse</th>
                            <th>Actions</th> <!-- Nouvelle colonne pour les actions -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fournisseurs as $fournisseur)
                            <tr>
                                <td>{{ $fournisseur->nom }}</td>
                                <td>{{ $fournisseur->email }}</td>
                                <td>{{ $fournisseur->contact }}</td>
                                <td>{{ $fournisseur->adresse }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editFournisseurModal{{ $fournisseur->id }}">
                                        Modifier
                                    </button>
                                    <form action="{{ route('fournisseurs.destroy', $fournisseur->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- / Fournisseurs Card -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addFournisseurModal" tabindex="-1" aria-labelledby="addFournisseurModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFournisseurModalLabel">Ajouter Fournisseur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('fournisseurs.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="contact" class="form-label">Téléphone</label>
                            <input type="text" class="form-control" id="contact" name="contact">
                        </div>
                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse">
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- / Modal -->

    <!-- Edit Modal -->
    @foreach ($fournisseurs as $fournisseur)
        <div class="modal fade" id="editFournisseurModal{{ $fournisseur->id }}" tabindex="-1"
            aria-labelledby="editFournisseurModalLabel{{ $fournisseur->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editFournisseurModalLabel{{ $fournisseur->id }}">Modifier Fournisseur
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('fournisseurs.update', $fournisseur->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nom{{ $fournisseur->id }}" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom{{ $fournisseur->id }}" name="nom"
                                    value="{{ $fournisseur->nom }}">
                            </div>
                            <div class="mb-3">
                                <label for="email{{ $fournisseur->id }}" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email{{ $fournisseur->id }}" name="email"
                                    value="{{ $fournisseur->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="contact{{ $fournisseur->id }}" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" id="contact{{ $fournisseur->id }}"
                                    name="contact" value="{{ $fournisseur->contact }}">
                            </div>
                            <div class="mb-3">
                                <label for="adresse{{ $fournisseur->id }}" class="form-label">Adresse</label>
                                <input type="text" class="form-control" id="adresse{{ $fournisseur->id }}"
                                    name="adresse" value="{{ $fournisseur->adresse }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- / Edit Modal -->
    <!-- / Content -->
@endsection
