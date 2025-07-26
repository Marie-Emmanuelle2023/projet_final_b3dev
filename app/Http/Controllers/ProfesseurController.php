<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Professeur;

class ProfesseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professeurs = Professeur::with('user')->get();
        return view('professeurs.index', compact('professeurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('professeurs.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        Professeur::create($validated);
        return redirect()->route('professeurs.index')->with('success', 'Professeur créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Professeur $professeur)
    {
        return view('professeurs.show', compact('professeur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Professeur $professeur)
    {
        $users = User::all();
        return view('professeurs.edit', compact('professeur', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Professeur $professeur)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        $professeur->update($validated);
        return redirect()->route('professeurs.index')->with('success', 'Professeur modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Professeur $professeur)
    {
        $professeur->delete();
        return redirect()->route('professeurs.index')->with('success', 'Professeur supprimé avec succès.');
    }
}
