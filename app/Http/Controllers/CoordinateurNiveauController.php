<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use App\Models\Coordinateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Contrôleur pour gérer l'affectation des coordinateurs aux niveaux
// Permet d'ajouter, afficher et retirer les affectations

class CoordinateurNiveauController extends Controller
{
    // Affiche la liste des niveaux avec leurs coordinateurs affectés
    public function index()
    {
        $niveaux = Niveau::with('coordinateurs.user')->get();
        return view('coordinateur_niveau.index', compact('niveaux'));
    }

    // Affiche le formulaire pour créer une nouvelle affectation
    public function create()
    {
        $coordinateurs = Coordinateur::with('user')->get();
        $niveaux = Niveau::all();
        $annees = \App\Models\AnneeAcademique::all();
        return view('coordinateur_niveau.create', compact('coordinateurs', 'niveaux', 'annees'));
    }

    // Enregistre une nouvelle affectation coordinateur-niveau pour une année académique
    public function store(Request $request)
    {
        $request->validate([
            'coordinateur_id' => 'required|exists:coordinateurs,id',
            'niveau_id' => 'required|exists:niveaux,id',
            'annee_academique_id' => 'required|exists:annee_academiques,id',
        ]);
        $niveau = Niveau::findOrFail($request->niveau_id);
        $niveau->coordinateurs()->attach($request->coordinateur_id, [
            'annee_academique_id' => $request->annee_academique_id,
        ]);
        return redirect()->route('coordinateur_niveau.index')->with('success', 'Affectation enregistrée.');
    }


    // Pas de modification d'une affectation (liaison pivot simple)

    // Retire un coordinateur d'un niveau (suppression de l'affectation)
    public function destroy(Request $request)
    {
        $request->validate([
            'coordinateur_id' => 'required|exists:coordinateurs,id',
            'niveau_id' => 'required|exists:niveaux,id',
        ]);
        $niveau = Niveau::findOrFail($request->niveau_id);
        $niveau->coordinateurs()->detach($request->coordinateur_id);
        return redirect()->route('coordinateur_niveau.index')->with('success', 'Affectation supprimée.');
    }
}
