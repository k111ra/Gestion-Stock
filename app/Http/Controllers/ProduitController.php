<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Models\Produit;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::all();
        $fournisseurs = Fournisseur::all();
        return view('produits.index', compact('produits', 'fournisseurs'));
    }

    public function create()
    {
        return view('produits.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'descriptions' => 'nullable|string',
            'categorie' => 'required|in:Alimentaire,Hygiène',
            'unite' => 'required|string|max:255',
            'conditionnement' => 'nullable|string',
            'prix_unitaire' => 'required|numeric', // Ajout de la validation pour prix_unitaire
        ]);

        Produit::create([
            'nom' => $request->nom,
            'descriptions' => $request->descriptions ?? null,
            'categorie' => $request->categorie,
            'unite' => $request->unite,
            'conditionnement' => $request->conditionnement ?? null,
            'prix_unitaire' => $request->prix_unitaire, // Ajout de prix_unitaire
        ]);

        return redirect()->back()->with('success', 'Produit ajouté avec succès');
    }

    public function edit(Produit $produit)
    {
        return view('produits.edit', compact('produit'));
    }

    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'descriptions' => 'nullable|string',
            'categorie' => 'required|in:Alimentaire,Hygiène',
            'unite' => 'required|string|max:255',
            'conditionnement' => 'nullable|string',
            'prix_unitaire' => 'required|numeric', // Ajout de la validation pour prix_unitaire
        ]);

        $produit->update([
            'nom' => $request->nom,
            'descriptions' => $request->descriptions ?? null,
            'categorie' => $request->categorie,
            'unite' => $request->unite,
            'conditionnement' => $request->conditionnement ?? null,
            'prix_unitaire' => $request->prix_unitaire,
        ]);

        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès');
    }

    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès');
    }
}
