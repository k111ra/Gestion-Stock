@extends('layouts.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Informations du produit -->
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Détails du stock - {{ $produit->nom }}</h5>
                        <a href="{{ route('stocks.index') }}" class="btn btn-secondary">Retour</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Produit :</strong> {{ $produit->nom }}</p>
                                <p><strong>Description :</strong> {{ $produit->description }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Stock actuel :</strong>
                                    <span class="@if ($stockActuel < 10) text-danger fw-bold @endif">
                                        {{ $stockActuel }}
                                    </span>
                                </p>
                                <p><strong>Prix unitaire :</strong>
                                    {{ number_format($produit->prix_unitaire, 0, ',', ' ') }} FCFA</p>
                                <p><strong>Valeur du stock :</strong>
                                    {{ number_format($stockActuel * $produit->prix_unitaire, 0, ',', ' ') }} FCFA</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Historique des mouvements -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Historique des mouvements</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Quantité</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mouvements as $mouvement)
                                    <tr>
                                        <td>{{ date('d/m/Y H:i', strtotime($mouvement->date_mouvement)) }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $mouvement->type_mouvement === 'Entrée' ? 'success' : 'danger' }}">
                                                {{ $mouvement->type_mouvement }}
                                            </span>
                                        </td>
                                        <td>{{ $mouvement->quantite }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
