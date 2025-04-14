<div class="modal fade" id="editMovementModal-{{ $mouvement->id }}" tabindex="-1"
    aria-labelledby="editMovementModalLabel{{ $mouvement->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('mouvements.update', $mouvement->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier le mouvement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    @foreach ($mouvement->produits as $index => $produit)
                        <div class="produit-group mb-4 border-bottom pb-2">
                            <div class="row g-3 align-items-end">
                                <div class="col-md-6">
                                    <label class="form-label">Produit</label>
                                    <select class="form-select" name="produits[{{ $index }}][produit_id]"
                                        required>
                                        <option value="">Choisir un produit...</option>
                                        @foreach ($produits as $p)
                                            <option value="{{ $p->id }}"
                                                {{ $produit->id == $p->id ? 'selected' : '' }}>
                                                {{ $p->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Quantité</label>
                                    <input type="number" name="produits[{{ $index }}][quantite]"
                                        class="form-control" required value="{{ $produit->pivot->quantite }}">
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="mb-3">
                        <label class="form-label">Type de Mouvement</label>
                        <select class="form-select" name="type_mouvement" required>
                            <option value="Entrée" {{ $mouvement->type_mouvement == 'Entrée' ? 'selected' : '' }}>Entrée
                            </option>
                            <option value="Sortie" {{ $mouvement->type_mouvement == 'Sortie' ? 'selected' : '' }}>
                                Sortie</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fournisseur</label>
                        <select class="form-select" name="fournisseur_id">
                            <option value="">Choisir un fournisseur...</option>
                            @foreach ($fournisseurs as $fournisseur)
                                <option value="{{ $fournisseur->id }}"
                                    {{ $mouvement->fournisseur_id == $fournisseur->id ? 'selected' : '' }}>
                                    {{ $fournisseur->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3" style="{{ $mouvement->type_mouvement == 'Sortie' ? '' : 'display:none;' }}">
                        <label class="form-label">Destination</label>
                        <input type="text" name="destination" class="form-control"
                            value="{{ $mouvement->destination }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="date_mouvement" class="form-control"
                            value="{{ $mouvement->date_mouvement }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Observation</label>
                        <textarea name="note" class="form-control" rows="3">{{ $mouvement->note }}</textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>
