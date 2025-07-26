<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Niveau;
use App\Models\AnneeAcademique;
use App\Models\Coordinateur;
use App\Models\User;
use App\Models\Role;

class CoordinateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coordinateurs = Coordinateur::with('user')->get();
        return view('coordinateurs.index', compact('coordinateurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $niveaux = Niveau::all();
        $annees = AnneeAcademique::all();
        // Récupérer l'id du rôle coordinateur dynamiquement
        $roleCoordinateur = Role::where('libelle', 'coordinateur')->first();
        $users = $roleCoordinateur ? User::where('role_id', $roleCoordinateur->id)->get() : collect();
        return view('coordinateurs.create', compact('niveaux', 'annees', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'niveaux' => 'required|array',
            'niveaux.*' => 'exists:niveaux,id',
            'annee_academique_id' => 'required|exists:annee_academiques,id',
        ]);

        $coordinateur = Coordinateur::create([
            'user_id' => $validated['user_id'],
        ]);

        // Associer les niveaux pour l'année académique donnée
        foreach ($validated['niveaux'] as $niveauId) {
            $coordinateur->niveaux()->attach($niveauId, [
                'annee_academique_id' => $validated['annee_academique_id']
            ]);
        }

        return redirect()->route('coordinateurs.index')->with('success', 'Coordinateur créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Coordinateur $coordinateur)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coordinateur $coordinateur)
    {
        $niveaux = Niveau::all();
        $annees = AnneeAcademique::all();
        $roleCoordinateur = Role::where('libelle', 'coordinateur')->first();
        $users = $roleCoordinateur ? User::where('role_id', $roleCoordinateur->id)->get() : collect();
        return view('coordinateurs.edit', compact('coordinateur', 'niveaux', 'annees', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coordinateur $coordinateur)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'niveaux' => 'required|array',
            'niveaux.*' => 'exists:niveaux,id',
            'annee_academique_id' => 'required|exists:annee_academiques,id',
        ]);

        $coordinateur->update([
            'user_id' => $validated['user_id'],
        ]);

        // Synchroniser les niveaux pour l'année académique donnée
        $syncData = [];
        foreach ($validated['niveaux'] as $niveauId) {
            $syncData[$niveauId] = ['annee_academique_id' => $validated['annee_academique_id']];
        }
        $coordinateur->niveaux()->sync($syncData);

        return redirect()->route('coordinateurs.index')->with('success', 'Coordinateur modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coordinateur $coordinateur)
    {
        // Détacher les niveaux (optionnel, car la suppression du coordinateur supprime les liens pivot)
        $coordinateur->niveaux()->detach();
        $coordinateur->delete();
        return redirect()->route('coordinateurs.index')->with('success', 'Coordinateur supprimé avec succès.');
    }
}
