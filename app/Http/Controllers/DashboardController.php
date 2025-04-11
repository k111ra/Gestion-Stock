<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $year = request('year', date('Y'));
            $currentYear = date('Y');
            $years = range(2025, $currentYear - 2); // Modification de la plage d'années

            // Total des produits
            $totalProduits = Produit::count();

            // Total des mouvements de l'année sélectionnée
            $totalMouvements = StockMovement::whereYear('created_at', $year)->count();

            // Calcul de la valeur du stock pour chaque produit
            $valeurStock = Produit::all()->sum(function ($produit) {
                $stockActuel = $produit->getStockActuelAttribute();
                return $stockActuel * $produit->prix_unitaire;
            });

            // Produits en alerte (stock <= 10)
            $produitsEnAlerte = Produit::all()->filter(function ($produit) {
                return $produit->getStockActuelAttribute() <= 10;
            });
            $alertes = $produitsEnAlerte->count();

            // Mouvements par mois pour l'année sélectionnée
            $mouvementsParMois = StockMovement::select(
                DB::raw('MONTH(created_at) as mois'),
                DB::raw('COUNT(*) as total')
            )
                ->whereYear('created_at', $year)
                ->groupBy('mois')
                ->orderBy('mois')
                ->get()
                ->mapWithKeys(function ($item) {
                    $nomMois = [
                        1 => 'Janvier',
                        2 => 'Février',
                        3 => 'Mars',
                        4 => 'Avril',
                        5 => 'Mai',
                        6 => 'Juin',
                        7 => 'Juillet',
                        8 => 'Août',
                        9 => 'Septembre',
                        10 => 'Octobre',
                        11 => 'Novembre',
                        12 => 'Décembre'
                    ];
                    return [$nomMois[$item->mois] => $item->total];
                });

            // Mouvements mensuels pour l'année sélectionnée
            $mouvementsEntrees = DB::table('stock_movements')
                ->select(DB::raw('MONTH(created_at) as mois'), DB::raw('COUNT(*) as total'))
                ->whereYear('created_at', $year)
                ->where('type_mouvement', 'Entrée')
                ->groupBy('mois')
                ->orderBy('mois')
                ->pluck('total', 'mois')
                ->toArray();

            $mouvementsSorties = DB::table('stock_movements')
                ->select(DB::raw('MONTH(created_at) as mois'), DB::raw('COUNT(*) as total'))
                ->whereYear('created_at', $year)
                ->where('type_mouvement', 'Sortie')
                ->groupBy('mois')
                ->orderBy('mois')
                ->pluck('total', 'mois')
                ->toArray();

            // Remplir les mois manquants avec des zéros
            $entreesParMois = array_fill(1, 12, 0);
            $sortiesParMois = array_fill(1, 12, 0);

            foreach ($mouvementsEntrees as $mois => $total) {
                $entreesParMois[$mois] = $total;
            }
            foreach ($mouvementsSorties as $mois => $total) {
                $sortiesParMois[$mois] = $total;
            }

            // Mouvements pour l'année sélectionnée et l'année courante
            $mouvementsParAnnee = [];
            $yearsToFetch = array_unique([$year, $currentYear]);

            foreach ($yearsToFetch as $y) {
                $mouvementsEntrees = DB::table('stock_movements')
                    ->join('produit_stock_movement', 'stock_movements.id', '=', 'produit_stock_movement.stock_movement_id')
                    ->select(
                        DB::raw('MONTH(stock_movements.created_at) as mois'),
                        DB::raw('SUM(produit_stock_movement.quantite) as total')
                    )
                    ->whereYear('stock_movements.created_at', $y)
                    ->where('type_mouvement', 'Entrée')
                    ->groupBy('mois')
                    ->orderBy('mois')
                    ->pluck('total', 'mois')
                    ->toArray();

                $mouvementsSorties = DB::table('stock_movements')
                    ->join('produit_stock_movement', 'stock_movements.id', '=', 'produit_stock_movement.stock_movement_id')
                    ->select(
                        DB::raw('MONTH(stock_movements.created_at) as mois'),
                        DB::raw('SUM(produit_stock_movement.quantite) as total')
                    )
                    ->whereYear('stock_movements.created_at', $y)
                    ->where('type_mouvement', 'Sortie')
                    ->groupBy('mois')
                    ->orderBy('mois')
                    ->pluck('total', 'mois')
                    ->toArray();

                // Remplir les mois manquants avec des zéros
                $entreesParMois = array_fill(1, 12, 0);
                $sortiesParMois = array_fill(1, 12, 0);

                foreach ($mouvementsEntrees as $mois => $total) {
                    $entreesParMois[$mois] = $total ?? 0;
                }
                foreach ($mouvementsSorties as $mois => $total) {
                    $sortiesParMois[$mois] = $total ?? 0;
                }

                $mouvementsParAnnee[$y] = [
                    'entrees' => array_values($entreesParMois),
                    'sorties' => array_values($sortiesParMois)
                ];
            }

            return view('index', [
                'selectedYear' => $year,
                'currentYear' => $currentYear,
                'totalProduits' => $totalProduits,
                'totalMouvements' => $totalMouvements,
                'valeurStock' => $valeurStock,
                'alertes' => $alertes,
                'produitsEnAlerte' => $produitsEnAlerte ?? collect([]),
                'mouvementsParMois' => $mouvementsParMois,
                'entreesParMois' => array_values($entreesParMois),
                'sortiesParMois' => array_values($sortiesParMois),
                'mouvementsParAnnee' => $mouvementsParAnnee,
                'years' => $years
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur dans DashboardController : ' . $e->getMessage());
            return view('index', [
                'selectedYear' => date('Y'),
                'currentYear' => date('Y'),
                'totalProduits' => 0,
                'totalMouvements' => 0,
                'valeurStock' => 0,
                'alertes' => 0,
                'produitsEnAlerte' => collect([]),
                'mouvementsParMois' => collect([]),
                'entreesParMois' => collect(array_fill(0, 12, 0)),
                'sortiesParMois' => collect(array_fill(0, 12, 0)),
                'mouvementsParAnnee' => [],
                'years' => []
            ]);
        }
    }
}
