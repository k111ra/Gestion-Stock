<!-- Modal -->
<div class="modal fade" id="addMovementModal" tabindex="-1" aria-labelledby="addMovementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold" id="addMovementModalLabel">
                    <i class='bx bx-transfer me-2'></i>Ajouter Mouvement
                </h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                                {{-- <div class="col-md-3">
                                    <label for="produits[0][prix_unitaire]" class="form-label">Prix unitaire</label>
                                    <input type="number" step="0.01" class="form-control"
                                        id="produits[0][prix_unitaire]" name="produits[0][prix_unitaire]" required
                                        placeholder="0.00">
                                </div> --}}
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
                    <div class="mb-3" id="note">
                        <label for="observation" class="form-label">Observation</label>
                        <textarea class="form-control" id="note" name="note" rows="3"></textarea>

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
        </div>
    </div>
</div>

@include('fournisseurs.create')
