<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produit;

class ProduitSeeder extends Seeder
{
    public function run(): void
    {
        $produits = [
            [
                'nom' => 'Huile de table Aya (12 x 0,9 L)',
                'categorie' => 'Alimentaire',
                'unite' => 'L',
                'conditionnement' => '12 x 0,9 L',
                'prix_unitaire' => 1500,
                'descriptions' => 'Conservé dans un endroit frais et sec à l’abri de la lumière'
            ],
            [
                'nom' => 'Riz blanc 5% brisures (50 Kg)',
                'categorie' => 'Alimentaire',
                'unite' => 'Kg',
                'conditionnement' => 'Sac de 50 Kg',
                'prix_unitaire' => 25000,
                'descriptions' => 'Conservé dans un endroit sec et frais'
            ],
            [
                'nom' => 'Riz grain rond 10% brisures (25 Kg)',
                'categorie' => 'Alimentaire',
                'unite' => 'Kg',
                'conditionnement' => 'Sac de 25 Kg',
                'prix_unitaire' => 12500,
                'descriptions' => 'Conservé dans un endroit sec et frais'
            ],
            [
                'nom' => 'Pâte d’arachide (25 Kg)',
                'categorie' => 'Alimentaire',
                'unite' => 'Kg',
                'conditionnement' => '25 Kg',
                'prix_unitaire' => 18000,
                'descriptions' => 'Conservé à température ambiante à l’abri de la chaleur et de l’humidité'
            ],
            [
                'nom' => 'Maïs (120 Kg)',
                'categorie' => 'Alimentaire',
                'unite' => 'Kg',
                'conditionnement' => 'Sacs',
                'prix_unitaire' => 12000,
                'descriptions' => '241 sacs bons / 100 sacs impropres à la consommation'
            ],
            [
                'nom' => 'Piment en poudre (50 Kg)',
                'categorie' => 'Alimentaire',
                'unite' => 'Kg',
                'conditionnement' => '50 Kg',
                'prix_unitaire' => 22000,
                'descriptions' => 'Conservé au sec à l’abri de la lumière'
            ],
            [
                'nom' => 'Gombo sec broyé (50 Kg)',
                'categorie' => 'Alimentaire',
                'unite' => 'Kg',
                'conditionnement' => '50 Kg',
                'prix_unitaire' => 25000,
                'descriptions' => 'Conservé au sec à l’abri de la lumière'
            ],
            [
                'nom' => 'Pâté de thon',
                'categorie' => 'Alimentaire',
                'unite' => 'Boîtes',
                'conditionnement' => 'Boîtes',
                'prix_unitaire' => 800,
                'descriptions' => 'Conservé dans un endroit frais et sec à l’abri de la lumière'
            ],
            [
                'nom' => 'Spaghetti (40 x 200 g)',
                'categorie' => 'Alimentaire',
                'unite' => 'Paquets',
                'conditionnement' => '40 x 200 g',
                'prix_unitaire' => 2000,
                'descriptions' => 'Conservé dans un endroit sec et frais'
            ],
            [
                'nom' => 'Tomate pâte (2200 g x 6)',
                'categorie' => 'Alimentaire',
                'unite' => 'Boîtes',
                'conditionnement' => '2200 g x 6',
                'prix_unitaire' => 2500,
                'descriptions' => 'Conservé dans un endroit sec et frais'
            ],
            [
                'nom' => 'Huile de palme (25 L)',
                'categorie' => 'Alimentaire',
                'unite' => 'L',
                'conditionnement' => '25 L',
                'prix_unitaire' => 1600,
                'descriptions' => 'Conservé dans un endroit frais et sec à l’abri de la lumière'
            ],
            [
                'nom' => 'Soja (50 Kg)',
                'categorie' => 'Alimentaire',
                'unite' => 'Kg',
                'conditionnement' => '50 Kg',
                'prix_unitaire' => 10000,
                'descriptions' => 'Conservé à température ambiante à l’abri de la chaleur et de l’humidité'
            ],
            [
                'nom' => 'Sucre granulé (25 Kg)',
                'categorie' => 'Alimentaire',
                'unite' => 'Kg',
                'conditionnement' => '25 Kg',
                'prix_unitaire' => 10000,
                'descriptions' => 'Conservé dans un endroit frais et sec à l’abri de la lumière'
            ],
            [
                'nom' => 'Lait évaporé (400 g x 24)',
                'categorie' => 'Alimentaire',
                'unite' => 'Boîtes',
                'conditionnement' => '400 g x 24',
                'prix_unitaire' => 1200,
                'descriptions' => 'Conservé dans un endroit frais et sec à l’abri de la lumière'
            ],
            [
                'nom' => 'Cube Maggi (25 x 100 x 4 g)',
                'categorie' => 'Alimentaire',
                'unite' => 'Boîtes',
                'conditionnement' => '25 x 100 x 4 g',
                'prix_unitaire' => 900,
                'descriptions' => 'Conservé dans un endroit frais et sec'
            ],
            [
                'nom' => 'Sel (25 Kg)',
                'categorie' => 'Alimentaire',
                'unite' => 'Kg',
                'conditionnement' => '25 Kg',
                'prix_unitaire' => 500,
                'descriptions' => 'Conservé dans un endroit frais et sec'
            ]
        ];

        foreach ($produits as $produit) {
            Produit::create($produit);
        }
    }
}
