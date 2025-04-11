<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
        $produits = Produit::all();

        foreach ($produits as $produit) {
            $produit->stock = $this->calculateStock($produit->id);
        }

        return view('stocks.index', compact('produits'));
    }

    private function calculateStock($produitId)
    {
        $stockEntree = DB::table('produit_stock_movement')
            ->join('stock_movements', 'stock_movements.id', '=', 'produit_stock_movement.stock_movement_id')
            ->where('produit_stock_movement.produit_id', $produitId)
            ->where('stock_movements.type_mouvement', 'Entrée')
            ->sum('produit_stock_movement.quantite');

        $stockSortie = DB::table('produit_stock_movement')
            ->join('stock_movements', 'stock_movements.id', '=', 'produit_stock_movement.stock_movement_id')
            ->where('produit_stock_movement.produit_id', $produitId)
            ->where('stock_movements.type_mouvement', 'Sortie')
            ->sum('produit_stock_movement.quantite');

        return $stockEntree - $stockSortie;
    }

    public function entreeStock(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|numeric|min:1',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'date_mouvement' => 'required|date'
        ]);

        $mouvement = StockMovement::create([
            'type_mouvement' => 'Entrée',
            'fournisseur_id' => $request->fournisseur_id,
            'date_mouvement' => $request->date_mouvement
        ]);

        $mouvement->produits()->attach($request->produit_id, [
            'quantite' => $request->quantite,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Entrée en stock enregistrée');
    }

    public function sortieStock(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|numeric|min:1',
            'destination' => 'required|string',
            'date_mouvement' => 'required|date'
        ]);

        $stockActuel = $this->calculateStock($request->produit_id);

        if ($stockActuel < $request->quantite) {
            return redirect()->back()->with('error', 'Stock insuffisant');
        }

        $mouvement = StockMovement::create([
            'type_mouvement' => 'Sortie',
            'destination' => $request->destination,
            'date_mouvement' => $request->date_mouvement
        ]);

        $mouvement->produits()->attach($request->produit_id, [
            'quantite' => $request->quantite,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Sortie de stock enregistrée');
    }

    public function stockDetail($produitId)
    {
        $produit = Produit::findOrFail($produitId);
        $stockActuel = $this->calculateStock($produitId);

        $mouvements = DB::table('produit_stock_movement')
            ->join('stock_movements', 'stock_movements.id', '=', 'produit_stock_movement.stock_movement_id')
            ->where('produit_stock_movement.produit_id', $produitId)
            ->orderBy('stock_movements.date_mouvement', 'desc')
            ->select('stock_movements.*', 'produit_stock_movement.quantite')
            ->get();

        return view('stocks.detail', compact('produit', 'stockActuel', 'mouvements'));
    }

    public function checkStock($produitId)
    {
        $produit = Produit::findOrFail($produitId);
        $stock = $this->calculateStock($produitId);

        return response()->json([
            'stock' => $stock,
            'seuil_alerte' => $stock < 10 ? true : false,
        ]);
    }
}
