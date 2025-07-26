<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeCours;

class TypeCoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = TypeCours::all();
        return view('type_cours.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('type_cours.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
        ]);
        $typeCours = TypeCours::create($validated);
        return redirect()->route('type_cours.index')->with('success', 'Type de cours créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeCours $typeCours)
    {
        return view('type_cours.show', compact('typeCours'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeCours $typeCours)
    {
        return view('type_cours.edit', compact('typeCours'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypeCours $typeCours)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
        ]);
        $typeCours->update($validated);
        return redirect()->route('type_cours.index')->with('success', 'Type de cours modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeCours $typeCours)
    {
        $typeCours->delete();
        return redirect()->route('type_cours.index')->with('success', 'Type de cours supprimé avec succès.');
    }
}
