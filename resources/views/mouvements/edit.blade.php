<div class="modal fade" id="editMovementModal-{{ $mouvement->id }}" tabindex="-1" aria-labelledby="editMovementModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMovementModalLabel">Modifier Mouvement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('mouvements.update', $mouvement->id) }}" method="POST">
                @csrf
                {{-- @method('PUT') --}}
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="produit_id" class="form-label">Produit</label>
                        <select class="form-select" id="produit_id" name="produit_id" required>
                            @foreach ($produits as $produit)
                                <option value="{{ $produit->id }}"
                                    {{ $mouvement->produit_id == $produit->id ? 'selected' : '' }}>{{ $produit->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="type_mouvement" class="form-label">Type de Mouvement</label>
                        <select class="form-select" id="type_mouvement" name="type_mouvement" required>
                            <option value="Entrée" {{ $mouvement->type_mouvement == 'Entrée' ? 'selected' : '' }}>Entrée
                            </option>
                            <option value="Sortie" {{ $mouvement->type_mouvement == 'Sortie' ? 'selected' : '' }}>Sortie
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantite" class="form-label">Quantité</label>
                        <input type="number" class="form-control" id="quantite" name="quantite"
                            value="{{ $mouvement->quantite }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="fournisseur_id" class="form-label">Fournisseur</label>
                        <select class="form-select" id="fournisseur_id" name="fournisseur_id">
                            <option value="">Sélectionner un fournisseur</option>
                            @foreach ($fournisseurs as $fournisseur)
                                <option value="{{ $fournisseur->id }}"
                                    {{ $mouvement->fournisseur_id == $fournisseur->id ? 'selected' : '' }}>
                                    {{ $fournisseur->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="destination" class="form-label">Destination</label>
                        <input type="text" class="form-control" id="destination" name="destination"
                            value="{{ $mouvement->destination }}">
                    </div>
                    <div class="mb-3">
                        <label for="date_mouvement" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date_mouvement" name="date_mouvement"
                            value="{{ $mouvement->date_mouvement }}" required>
                    </div>
                    <div class="mb-3" id="note">
                        <label for="note" class="form-label">Observation</label>
                        <textarea class="form-control" id="note" name="note" rows="3"></textarea>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
