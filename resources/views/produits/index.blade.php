@extends('layouts.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Liste des produits</h5>
            <div class="d-flex justify-content-end p-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProductModal">
                    Ajouter
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
                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Descriptions</th>
                            <th>Catégories</th>
                            <th>Unités</th>
                            <th>Conditionnements</th>
                            <th>Prix Unitaires</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($produits as $produit)
                            <tr>
                                <td>{{ $produit->nom }}</td>
                                <td>{{ $produit->descriptions }}</td>
                                <td>{{ $produit->categorie }}</td>
                                <td>{{ $produit->unite }}</td>
                                <td>{{ $produit->conditionnement }}</td>
                                <td>{{ $produit->prix_unitaire }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#editProductModal{{ $produit->id }}">
                                                <i class="bx bx-edit-alt me-1"></i> Modifier
                                            </a>

                                            <form action="{{ route('produits.destroy', $produit->id) }}" method="POST"
                                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item" type="submit">
                                                    <i class="bx bx-trash me-1"></i> Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            {{-- ⬇️ Insère le MODAL juste après la ligne --}}
                            <div class="modal fade" id="editProductModal{{ $produit->id }}" tabindex="-1"
                                aria-labelledby="editProductModalLabel{{ $produit->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editProductModalLabel{{ $produit->id }}">
                                                Modifier le produit
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('produits.update', $produit->id) }}" method="POST">
                                                @csrf
                                                @method('PUT') {{-- ⚠️ Correction ici --}}
                                                <div class="form-group mb-2">
                                                    <label for="nom">Nom</label>
                                                    <input type="text" name="nom" class="form-control"
                                                        value="{{ $produit->nom }}" required>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="descriptions">Descriptions</label>
                                                    <textarea name="descriptions" class="form-control">{{ $produit->descriptions }}</textarea>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="categorie">Catégorie</label>
                                                    <select name="categorie" class="form-control" required>
                                                        <option value="Alimentaire"
                                                            {{ $produit->categorie == 'Alimentaire' ? 'selected' : '' }}>
                                                            Alimentaire</option>
                                                        <option value="Hygiène"
                                                            {{ $produit->categorie == 'Hygiène' ? 'selected' : '' }}>
                                                            Hygiène</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="quantite">Quantité</label>
                                                    <input type="number" name="quantite" class="form-control"
                                                        value="{{ $produit->quantite }}">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="unite">Unité</label>
                                                    <input type="text" name="unite" class="form-control"
                                                        value="{{ $produit->unite }}">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="conditionnement">Conditionnement</label>
                                                    <input type="text" name="conditionnement" class="form-control"
                                                        value="{{ $produit->conditionnement }}">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="prix_unitaire">Prix Unitaire</label>
                                                    <input type="text" name="prix_unitaire" class="form-control"
                                                        value="{{ $produit->prix_unitaire }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Annuler</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('produits.create')
    @include('produits.edit')
@endsection
