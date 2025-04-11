@extends('layouts.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Gestion des stocks</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Stock Disponible</th>
                            <th>Montant du Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produits as $produit)
                            <tr>
                                <td>{{ $produit->nom }}</td>
                                <td @if ($produit->stock < 10) class="text-danger fw-bold" @endif>
                                    {{ $produit->stock }}
                                    @if ($produit->stock < 10)
                                        <span class="badge bg-danger">Stock faible</span>
                                    @endif
                                </td>
                                <td>{{ number_format($produit->stock * $produit->prix_unitaire, 0, ',', ' ') }} F CFA</td>
                                <td>
                                    <a href="{{ route('stocks.detail', ['produit' => $produit->id]) }}"
                                        class="btn btn-info btn-sm">
                                        Détails
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
