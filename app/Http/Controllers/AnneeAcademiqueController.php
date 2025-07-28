<?php

namespace App\Http\Controllers;

use App\Models\AnneeAcademique;
use Illuminate\Http\Request;
use App\Models\Annee;
use App\Models\Classe;

class AnneeAcademiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anneesAcademiques = AnneeAcademique::with(['annee', 'classe'])->get();
        return view('annee_academiques.index', compact('anneesAcademiques'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $annees = Annee::all();
        $classes = Classe::all();
        return view('annee_academiques.create', compact('annees', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'annee_id' => 'required|exists:annees,id',
            'classe_id' => 'required|exists:classes,id',
            'debut' => 'required|date',
            'fin' => 'required|date|after:debut',
            'en_cours' => 'nullable|boolean',
        ]);

        if ($request->en_cours) {
            AnneeAcademique::where('en_cours', true)->update(['en_cours' => false]);
        }

        AnneeAcademique::create($validated);
        return redirect()->route('annee_academiques.index')->with('success', 'Année académique ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AnneeAcademique $anneeAcademique)
    {
        return view('annee_academiques.show', compact('anneeAcademique'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnneeAcademique $anneeAcademique)
    {
        $annees = Annee::all();
        $classes = Classe::all();
        return view('annee_academiques.edit', compact('anneeAcademique', 'annees', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnneeAcademique $anneeAcademique)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'annee_id' => 'required|exists:annees,id',
            'classe_id' => 'required|exists:classes,id',
            'debut' => 'required|date',
            'fin' => 'required|date|after:debut',
            'en_cours' => 'nullable|boolean',
        ]);

        if ($request->en_cours) {
            AnneeAcademique::where('en_cours', true)->where('id', '!=', $anneeAcademique->id)->update(['en_cours' => false]);
        }

        $anneeAcademique->update($validated);
        return redirect()->route('annee_academiques.index')->with('success', 'Année académique modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnneeAcademique $anneeAcademique)
    {
        $anneeAcademique->delete();
        return redirect()->route('annee_academiques.index')->with('success', 'Année académique supprimée.');
    }
}
