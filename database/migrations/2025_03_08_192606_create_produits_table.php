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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('descriptions')->nullable(); // Correction de l'orthographe
            $table->enum('categorie', ['Alimentaire', 'Hygiène']);
            $table->string('unite');
            $table->string('conditionnement')->nullable(); // Ajout du conditionnement
            $table->decimal('prix_unitaire', 12, 0); // Ajout de la colonne prix_unitaire
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
