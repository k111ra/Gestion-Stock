<div class="container">
    {{-- <h1>Mettre à jour le produit</h1> --}}
    <div class="modal fade" id="editProductModal{{ $produit->id }}" tabindex="-1" aria-labelledby="editProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Mettre à jour le produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('produits.update', $produit->id) }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label for="nom">Nom du produit</label>
                            <input type="text" class="form-control" id="nom" name="nom"
                                value="{{ $produit->nom }}" required>
                        </div>

                        <div class="form-group">
                            <label for="descriptions">Descriptions</label>
                            <textarea class="form-control" id="descriptions" name="descriptions">{{ $produit->descriptions }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="categorie">Catégorie</label>
                            <select class="form-control" id="categorie" name="categorie" required>
                                <option value="Alimentaire"
                                    {{ $produit->categorie == 'Alimentaire' ? 'selected' : '' }}>Alimentaire
                                </option>
                                <option value="Hygiène" {{ $produit->categorie == 'Hygiène' ? 'selected' : '' }}>Hygiène
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="quantite">Quantité</label>
                            <input type="number" class="form-control" id="quantite" name="quantite"
                                value="{{ $produit->quantite }}" required>
                        </div>

                        <div class="form-group">
                            <label for="unite">Unité</label>
                            <input type="text" class="form-control" id="unite" name="unite"
                                value="{{ $produit->unite }}" required>
                        </div>

                        <div class="form-group">
                            <label for="conditionnement">Conditionnement</label>
                            <input type="text" class="form-control" id="conditionnement" name="conditionnement"
                                value="{{ $produit->conditionnement }}">
                        </div>

                        <div class="form-group">
                            <label for="prix_unitaire">Prix Unitaire</label>
                            <input type="text" class="form-control" id="prix_unitaire" name="prix_unitaire"
                                value="{{ $produit->prix_unitaire }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
