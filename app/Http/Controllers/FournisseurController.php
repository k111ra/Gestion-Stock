<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseur;

class FournisseurController extends Controller
{
    public function index()
    {
        $fournisseurs = Fournisseur::all();
        return view('fournisseurs.index', compact('fournisseurs'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'contact' => 'required|string|max:255|unique:fournisseurs',
            'email' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
        ]);

        Fournisseur::create([
            'nom' => $request->nom,
            'contact' => $request->contact,
            'email' => $request->email,
            'adresse' => $request->adresse,
        ]);

        return redirect()->back()->with('success', 'Fournisseur ajouté avec succès');
    }

    public function destroy($id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->delete();

        return redirect()->back()->with('success', 'Fournisseur supprimé avec succès');
    }
}
