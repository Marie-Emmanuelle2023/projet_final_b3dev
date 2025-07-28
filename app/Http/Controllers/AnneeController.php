<?php

namespace App\Http\Controllers;

use App\Models\Annee;
use Illuminate\Http\Request;

class AnneeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $annees = Annee::all();
        return view('annees.index', compact('annees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('annees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|unique:annees',
        ]);
        Annee::create($validated);
        return redirect()->route('annees.index')->with('success', 'Année ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Annee $annee)
    {
        return view('annees.show', compact('annee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Annee $annee)
    {
        return view('annees.edit', compact('annee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Annee $annee)
    {
        $validated = $request->validate([
            'nom' => 'required|string|unique:annees,nom,' . $annee->id,
        ]);
        $annee->update($validated);
        return redirect()->route('annees.index')->with('success', 'Année modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Annee $annee)
    {
        $annee->delete();
        return redirect()->route('annees.index')->with('success', 'Année supprimée.');
    }
}
