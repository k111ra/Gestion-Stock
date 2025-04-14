<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'categorie',
        'quantite',
        'unite',
        'conditionnement',
        'descriptions',
        'date_peremption',
        'etat_stock',
        'fournisseur_id',
        'prix_unitaire', // Ajout du champ prix_unitaire
        'seuil_alerte' // Ajout du champ seuil_alerte
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function getStockActuelAttribute()
    {
        $entrees = $this->mouvements()
            ->where('type_mouvement', 'Entrée')
            ->sum('produit_stock_movement.quantite');

        $sorties = $this->mouvements()
            ->where('type_mouvement', 'Sortie')
            ->sum('produit_stock_movement.quantite');

        return $entrees - $sorties;
    }

    public function getStockAttribute()
    {
        // Exemple : calculer le stock à partir des mouvements
        $entrées = $this->mouvements()->where('type_mouvement', 'Entrée')->sum('quantite');
        $sorties = $this->mouvements()->where('type_mouvement', 'Sortie')->sum('quantite');
        return $entrées - $sorties;
    }

    public function mouvements()
    {
        return $this->belongsToMany(StockMovement::class, 'produit_stock_movement')
            ->withPivot('quantite')
            ->withTimestamps();
    }
}
