<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Niveau;

class NiveauController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $niveaux = Niveau::all();
        return view('niveaux.index', compact('niveaux'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('niveaux.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
        ]);
        Niveau::create($validated);
        return redirect()->route('niveaux.index')->with('success', 'Niveau créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Niveau $niveau)
    {
        return view('niveaux.show', compact('niveau'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Niveau $niveau)
    {
        return view('niveaux.edit', compact('niveau'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Niveau $niveau)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
        ]);
        $niveau->update($validated);
        return redirect()->route('niveaux.index')->with('success', 'Niveau modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Niveau $niveau)
    {
        $niveau->delete();
        return redirect()->route('niveaux.index')->with('success', 'Niveau supprimé avec succès.');
    }
}
