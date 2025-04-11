<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->enum('type_mouvement', ['Entrée', 'Sortie']);
            $table->unsignedBigInteger('fournisseur_id')->nullable(); // Uniquement pour les entrées
            $table->string('destination')->nullable(); // Uniquement pour les sorties
            $table->date('date_mouvement'); // Renommé de date_mouvement à date
            $table->timestamps();

            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs')->onDelete('set null');
        });

        Schema::create('produit_stock_movement', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produit_id');
            $table->unsignedBigInteger('stock_movement_id');
            $table->integer('quantite');
            $table->decimal('prix_unitaire', 12, 0); // Ajout de la colonne prix_unitaire
            $table->timestamps();

            $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
            $table->foreign('stock_movement_id')->references('id')->on('stock_movements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produit_stock_movement');
        Schema::dropIfExists('stock_movements');
    }
};
