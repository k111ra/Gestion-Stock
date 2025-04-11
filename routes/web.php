<?php

use App\Http\Controllers\DashboardController;  // Modifier cette ligne
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\Auth\AuthController;
use App\Models\StockMovement;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Définition des routes pour la gestion des stocks.
| Ces routes sont chargées par le RouteServiceProvider.
|
*/

// Accueil
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Routes Produits
Route::prefix('produits')->name('produits.')->group(function () {
    Route::get('/', [ProduitController::class, 'index'])->name('index');
    Route::get('/create', [ProduitController::class, 'create'])->name('create');
    Route::post('/store', [ProduitController::class, 'store'])->name('store');
    Route::get('/{produit}/edit', [ProduitController::class, 'edit'])->name('edit');
    Route::post('/{produit}/update', [ProduitController::class, 'update'])->name('update');
});

// Routes Fournisseurs
Route::prefix('fournisseurs')->name('fournisseurs.')->group(function () {
    Route::get('/', [FournisseurController::class, 'index'])->name('index');
    Route::get('/create', [FournisseurController::class, 'create'])->name('create');
    Route::post('/store', [FournisseurController::class, 'store'])->name('store');
    Route::post('/{fournisseur}/update', [FournisseurController::class, 'update'])->name('update');
    Route::delete('/{fournisseur}', [FournisseurController::class, 'destroy'])->name('destroy');
});

// Routes Mouvements de Stock
Route::prefix('mouvements')->name('mouvements.')->group(function () {
    Route::get('/', [StockMovementController::class, 'index'])->name('index');
    Route::get('/create', [StockMovementController::class, 'create'])->name('create');
    Route::post('/store', [StockMovementController::class, 'store'])->name('store');
    Route::post('/edit', [StockMovementController::class, 'edit'])->name('edit');
    Route::post('/{mouvement}/update', [StockMovementController::class, 'update'])->name('update');
    Route::delete('/{mouvement}', [StockMovementController::class, 'destroy'])->name('destroy');
    Route::get('/{id}/printBonSortie', [StockMovementController::class, 'printBonSortie'])->name('printBonSortie');
    Route::get('/{id}/printBonLivraison', [StockMovementController::class, 'printBonLivraison'])->name('printBonLivraison');
    Route::post('/filter', [StockMovementController::class, 'filterByDate'])->name('mouvements.filter');
});

// Routes d'authentification
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Routes de réinitialisation de mot de passe
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protection des routes existantes
Route::middleware(['auth'])->group(function () {
    // Routes pour les administrateurs uniquement
    Route::middleware(['role:admin'])->group(function () {
        // Routes d'administration
    });

    // Routes pour les managers
    Route::middleware(['role:manager'])->group(function () {
        // Routes de gestion
    });

    // Routes accessibles à tous les utilisateurs authentifiés
    Route::prefix('stocks')->name('stocks.')->group(function () {
        Route::get('/', [StockController::class, 'index'])->name('index');
        Route::get('/{produit}/detail', [StockController::class, 'stockDetail'])->name('detail');
        Route::get('/check/{produit}', [StockController::class, 'checkStock'])->name('check');
        Route::post('/entree', [StockController::class, 'entreeStock'])->name('entree');
        Route::post('/sortie', [StockController::class, 'sortieStock'])->name('sortie');
    });
});
