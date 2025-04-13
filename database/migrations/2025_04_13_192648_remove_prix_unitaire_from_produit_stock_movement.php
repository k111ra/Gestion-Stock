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
        Schema::table('produit_stock_movement', function (Blueprint $table) {
            $table->dropColumn('prix_unitaire');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produit_stock_movement', function (Blueprint $table) {
            $table->decimal('prix_unitaire', 10, 2)->nullable(); // Remets la colonne si on rollback
        });
    }
};
