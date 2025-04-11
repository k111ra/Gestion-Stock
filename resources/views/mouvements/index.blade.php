@extends('layouts.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <h5 class="card-header">Mouvements de Stock</h5>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('mouvements.store') }}" method="POST">
                    @csrf
                    <div id="produitsContainer">
                        <div class="produit-group mb-3">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="produits[0][produit_id]" class="form-label">Produit</label>
                                    <div class="input-group">
                                        <select class="form-select" id="produits[0][produit_id]"
                                            name="produits[0][produit_id]" required>
                                            <option value="">Choisir un produit...</option>
                                            @foreach ($produits as $produit)
                                                <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-outline-primary openAddProductModal" type="button">
                                            <i class="bx bx-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="produits[0][quantite]" class="form-label">Quantité</label>
                                    <input type="number" class="form-control" id="produits[0][quantite]"
                                        name="produits[0][quantite]" required placeholder="0">
                                </div>
                                <div class="col-md-3">
                                    <label for="produits[0][prix_unitaire]" class="form-label">Prix unitaire</label>
                                    <input type="number" step="0.01" class="form-control"
                                        id="produits[0][prix_unitaire]" name="produits[0][prix_unitaire]" required
                                        placeholder="0.00">
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger btn-sm delete-produit">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <button type="button"
                                class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center gap-2"
                                id="addProduit">
                                <i class="bx bx-plus"></i>
                                <span>Ajouter un produit</span>
                            </button>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="type_mouvement" class="form-label">Type</label>
                                <select class="form-control" id="type_mouvement" name="type_mouvement" required>
                                    <option value="Entrée">Entrée</option>
                                    <option value="Sortie">Sortie</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date_mouvement" class="form-label">Date</label>
                                <input type="date" class="form-control" id="date_mouvement" name="date_mouvement"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3" id="fournisseurField">
                        <label for="fournisseur_id" class="form-label">Fournisseur</label>
                        <div class="input-group">
                            <select class="form-select" id="fournisseur_id" name="fournisseur_id" required>
                                <option value="">Choisir un fournisseur...</option>
                                @foreach ($fournisseurs as $fournisseur)
                                    <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-outline-primary" type="button" id="addFournisseurBtn">
                                <i class="bx bx-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3" id="destinationField" style="display:none;">
                        <label for="destination" class="form-label">Destination</label>
                        <input type="text" class="form-control" id="destination" name="destination" required>
                    </div>

                    <div class="modal-footer border-top-0 px-0 pb-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            <i class='bx bx-x me-1'></i>Annuler
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class='bx bx-save me-1'></i>Enregistrer
                        </button>
                    </div>
                </form>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produits</th>
                            <th>Type</th>
                            <th>Fournisseur/Destination</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($mouvements as $mouvement)
                            <tr>
                                <td>
                                    @foreach ($mouvement->produits as $produit)
                                        <strong>{{ $produit->nom }} ({{ $produit->pivot->quantite }})</strong><br>
                                    @endforeach
                                </td>
                                <td>
                                    <span
                                        class="badge bg-label-{{ $mouvement->type_mouvement == 'Entrée' ? 'success' : 'danger' }}">
                                        {{ $mouvement->type_mouvement }}
                                    </span>
                                </td>
                                <td>{{ $mouvement->type_mouvement == 'Entrée' ? $mouvement->fournisseur->nom ?? '-' : $mouvement->destination ?? '-' }}
                                </td>
                                <td>{{ $mouvement->date_mouvement }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editMovementModal-{{ $mouvement->id }}">
                                        Modifier
                                    </button>
                                    @include('mouvements.edit', [
                                        'mouvement' => $mouvement,
                                        'produits' => $produits,
                                        'fournisseurs' => $fournisseurs,
                                    ])
                                    <form action="{{ route('mouvements.destroy', $mouvement->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                    </form>
                                    @if ($mouvement->type_mouvement == 'Sortie')
                                        <a href="{{ route('mouvements.printBonSortie', $mouvement->id) }}"
                                            class="btn btn-sm btn-info">
                                            Imprimer Bon de Sortie
                                        </a>
                                        <a href="{{ route('mouvements.printBonLivraison', $mouvement->id) }}"
                                            class="btn btn-sm btn-secondary">
                                            Imprimer Bon de Livraison
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modals -->
        @include('produits.create')
        @include('fournisseurs.create')
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const elements = {
                typeMouvement: document.getElementById("type_mouvement"),
                fournisseurField: document.getElementById("fournisseurField"),
                destinationField: document.getElementById("destinationField"),
                addProduitBtn: document.getElementById("addProduit"),
                produitsContainer: document.getElementById("produitsContainer"),
                productModal: document.getElementById('createProductModal'),
                fournisseurModal: document.getElementById('addFournisseurModal'),
                addFournisseurBtn: document.getElementById('addFournisseurBtn')
            };

            // Initialisation des modals Bootstrap
            let productModal, fournisseurModal;
            if (elements.productModal) {
                productModal = new bootstrap.Modal(elements.productModal);
            }
            if (elements.fournisseurModal) {
                fournisseurModal = new bootstrap.Modal(elements.fournisseurModal);
            }

            // Gérer le clic sur le bouton d'ajout de fournisseur
            elements.addFournisseurBtn.addEventListener('click', () => {
                if (fournisseurModal) {
                    fournisseurModal.show();
                } else {
                    console.error('Modal fournisseur non trouvée');
                }
            });

            // Gestion du type de mouvement
            elements.typeMouvement.addEventListener("change", function() {
                const isEntree = this.value === "Entrée";
                elements.fournisseurField.style.display = isEntree ? "block" : "none";
                elements.destinationField.style.display = isEntree ? "none" : "block";

                // Reset les champs requis en fonction du type
                elements.fournisseurField.querySelector('select').required = isEntree;
                elements.destinationField.querySelector('input').required = !isEntree;
            });

            // Fonction pour créer un nouveau groupe de produits
            function createProduitGroup(index) {
                return `
                    <div class="produit-group mb-3">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="produits[${index}][produit_id]" class="form-label">Produit</label>
                                <div class="input-group">
                                    <select class="form-select" id="produits[${index}][produit_id]" name="produits[${index}][produit_id]" required>
                                        <option value="">Choisir un produit</option>
                                        @foreach ($produits as $produit)
                                            <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-outline-primary openAddProductModal" type="button">
                                        <i class="bx bx-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="produits[${index}][quantite]" class="form-label">Quantité</label>
                                <input type="number" class="form-control" id="produits[${index}][quantite]"
                                       name="produits[${index}][quantite]" required min="1" placeholder="0">
                            </div>
                            <div class="col-md-3">
                                <label for="produits[${index}][prix_unitaire]" class="form-label">Prix unitaire</label>
                                <input type="number" step="0.01" class="form-control" id="produits[${index}][prix_unitaire]"
                                       name="produits[${index}][prix_unitaire]" required min="0" placeholder="0.00">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-sm delete-produit">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            }

            // Gestion des événements des produits
            const produitManager = {
                addProduit() {
                    const index = document.querySelectorAll('.produit-group').length;
                    elements.produitsContainer.insertAdjacentHTML('beforeend', createProduitGroup(index));
                    this.updateDeleteButtons();
                    this.initializeModalButtons();
                },

                updateDeleteButtons() {
                    const deleteButtons = document.querySelectorAll('.delete-produit');
                    const nbProduits = document.querySelectorAll('.produit-group').length;

                    deleteButtons.forEach(button => {
                        button.style.display = nbProduits > 1 ? 'block' : 'none';
                        button.onclick = () => {
                            if (nbProduits > 1) {
                                button.closest('.produit-group').remove();
                                this.updateDeleteButtons();
                            }
                        };
                    });
                },

                initializeModalButtons() {
                    document.querySelectorAll('.openAddProductModal').forEach(button => {
                        button.onclick = () => {
                            if (productModal) {
                                productModal.show();
                            } else {
                                console.error('Modal produit non trouvée');
                            }
                        };
                    });
                }
            };

            // Initialisation
            elements.addProduitBtn.addEventListener("click", () => produitManager.addProduit());
            produitManager.updateDeleteButtons();
            produitManager.initializeModalButtons();

            // Déclencher l'événement change initial pour configurer les champs correctement
            elements.typeMouvement.dispatchEvent(new Event('change'));
        });
    </script>
@endsection
