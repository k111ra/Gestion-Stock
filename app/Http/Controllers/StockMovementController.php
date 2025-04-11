<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockMovement;
use App\Models\Produit;
use App\Models\Fournisseur;
use Barryvdh\DomPDF\Facade\Pdf;

class StockMovementController extends Controller
{
    public function index()
    {
        $mouvements = StockMovement::with('produits', 'fournisseur')->get();
        $produits = Produit::all();
        $fournisseurs = Fournisseur::all();
        return view('mouvements.index', compact('mouvements', 'produits', 'fournisseurs'));
    }

    public function create()
    {
        $produits = Produit::all();
        $fournisseurs = Fournisseur::all();
        return view('mouvements.create', compact('produits', 'fournisseurs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produits' => 'required|array',
            'produits.*.produit_id' => 'required|exists:produits,id',
            'produits.*.quantite' => 'required|integer|min:1',
            'produits.*.prix_unitaire' => 'required|numeric|min:0',
            'type_mouvement' => 'required|in:Entrée,Sortie',
            'fournisseur_id' => 'nullable|exists:fournisseurs,id',
            'destination' => 'nullable|string',
            'date_mouvement' => 'required|date'
        ]);

        $mouvement = StockMovement::create([
            'type_mouvement' => $request->type_mouvement,
            'fournisseur_id' => $request->fournisseur_id,
            'destination' => $request->destination,
            'date_mouvement' => $request->date_mouvement
        ]);

        foreach ($request->produits as $produit) {
            $mouvement->produits()->attach($produit['produit_id'], [
                'quantite' => $produit['quantite'],
                'prix_unitaire' => $produit['prix_unitaire']
            ]);
        }
        $mouvement->save();

        return redirect()->route('mouvements.index')->with('success', 'Mouvement enregistré avec succès');
    }

    public function edit(Request $request)
    {
        $mouvement = StockMovement::findOrFail($request->id);
        $produits = Produit::all();
        $fournisseurs = Fournisseur::all();
        return view('mouvements.edit', compact('mouvement', 'produits', 'fournisseurs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'produits' => 'required|array',
            'produits.*.produit_id' => 'required|exists:produits,id',
            'produits.*.quantite' => 'required|integer|min:1',
            'produits.*.prix_unitaire' => 'required|numeric|min:0',
            'type_mouvement' => 'required|in:Entrée,Sortie',
            'fournisseur_id' => 'nullable|exists:fournisseurs,id',
            'destination' => 'nullable|string',
            'date_mouvement' => 'required|date'
        ]);

        $mouvement = StockMovement::findOrFail($id);
        $mouvement->update([
            'type_mouvement' => $request->type_mouvement,
            'fournisseur_id' => $request->fournisseur_id,
            'destination' => $request->destination,
            'date_mouvement' => $request->date_mouvement
        ]);

        // Détacher tous les produits existants
        $mouvement->produits()->detach();

        // Attacher les nouveaux produits avec leurs quantités et prix
        foreach ($request->produits as $produit) {
            $mouvement->produits()->attach($produit['produit_id'], [
                'quantite' => $produit['quantite'],
                'prix_unitaire' => $produit['prix_unitaire']
            ]);
        }

        return redirect()->route('mouvements.index')->with('success', 'Mouvement modifié avec succès');
    }

    public function destroy($id)
    {
        $mouvement = StockMovement::findOrFail($id);
        $mouvement->delete();

        return redirect()->back()->with('success', 'Mouvement supprimé avec succès');
    }

    public function printBonSortie($id)
    {
        $mouvement = StockMovement::with('produits', 'fournisseur')->findOrFail($id);
        $pdf = Pdf::loadView('mouvements.pdf.bonSortie', compact('mouvement'));
        return $pdf->download('BonSortie_' . $mouvement->id . '.pdf');
    }

    public function printBonLivraison($id)
    {
        try {
            $mouvement = StockMovement::with(['produits', 'fournisseur'])
                ->where('id', $id)
                ->where('type_mouvement', 'Sortie')  // Changé de 'Entrée' à 'Sortie'
                ->firstOrFail();

            $pdf = Pdf::loadView('mouvements.pdf.bonLivraison', compact('mouvement'));
            $filename = 'BonLivraison_' . str_replace(' ', '_', $mouvement->destination ?? 'sans_destination') . '_' . date('d-m-Y') . '.pdf';

            return $pdf->download($filename);
        } catch (\Exception $e) {
            \Log::error('Erreur génération PDF: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ce mouvement ne peut pas générer un bon de livraison.');
        }
    }

    public function filterByDate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $mouvements = StockMovement::whereBetween('date_mouvement', [$request->start_date, $request->end_date])
            ->with('produits', 'fournisseur')
            ->get();

        return view('mouvements.index', compact('mouvements'));
    }
}
