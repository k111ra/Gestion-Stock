<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produit;

class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_mouvement', // Entrée ou Sortie
        'fournisseur_id', // Null si sortie
        'destination', // Null si entrée
        'date_mouvement'
    ];
    protected $casts = [
        'date_mouvement' => 'date', // Permet de convertir en Carbon automatiquement
    ];

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'produit_stock_movement')->withPivot('quantite')->withTimestamps();
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
}
