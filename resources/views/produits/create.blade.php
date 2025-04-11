<!-- Modal -->
<div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold" id="addProductModalLabel">
                    <i class='bx bx-package me-2'></i>Ajouter un produit
                </h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('produits.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="productName" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="productName" name="nom"
                            value="{{ old('nom') }}">
                        @error('nom')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Descriptions</label>
                        <textarea class="form-control" id="productDescription" name="descriptions">{{ old('descriptions') }}</textarea>
                        @error('descriptions')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Catégorie</label>
                        <select class="form-select" id="categorie" name="categorie">
                            <option value="Alimentaire">Alimentaire</option>
                            <option value="Hygiène">Hygiène</option>
                        </select>
                        @error('categorie')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="productUnit" class="form-label">Unité</label>
                        <input type="text" class="form-control" id="unite" name="unite"
                            value="{{ old('unite') }}">
                        @error('unite')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="productPackaging" class="form-label">Conditionnement</label>
                        <input type="text" class="form-control" id="conditionnement" name="conditionnement"
                            value="{{ old('conditionnement') }}">
                        @error('conditionnement')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="productUnitPrice" class="form-label">Prix Unitaire</label>
                        <input type="text" class="form-control" id="productUnitPrice" name="prix_unitaire"
                            value="{{ old('prix_unitaire') }}">
                        @error('prix_unitaire')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer border-top-0 px-0 pb-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            <i class='bx bx-x me-1'></i>Annuler
                        </button>
                        <button type="submit" class="btn btn-primary" id="addProductButton">
                            <i class='bx bx-save me-1'></i>Enregistrer
                        </button>
                    </div>
                </form>
                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
