<?php

namespace App\Http\Controllers;
use App\Models\Etudiant;
use App\Models\ParentEtudiant;
use App\Models\ParentModel;
use Illuminate\Http\Request;

class ParentEtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parentEtudiants = ParentEtudiant::with(['parentModel', 'etudiant.user'])->get();
        return view('parents.index', compact('parentEtudiants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = ParentModel::all();
        $etudiants = Etudiant::with('user')->get();
        return view('parents.create', compact('parents', 'etudiants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_model_id' => 'required|exists:parent_models,id',
            'etudiant_id' => 'required|exists:etudiants,id',
        ]);
        ParentEtudiant::create($validated);
        return redirect()->route('parents.index')->with('success', "Parent d'étudiant ajouté avec succès.");
    }

    /**
     * Display the specified resource.
     */
    public function show(ParentEtudiant $parentEtudiant)
    {
        $parentEtudiant->load(['parentModel', 'etudiant.user']);
        return view('parents.show', compact('parentEtudiant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParentEtudiant $parentEtudiant)
    {
        $parents = ParentModel::all();
        $etudiants = Etudiant::with('user')->get();
        return view('parents.edit', compact('parentEtudiant', 'parents', 'etudiants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ParentEtudiant $parentEtudiant)
    {
        $validated = $request->validate([
            'parent_model_id' => 'required|exists:parent_models,id',
            'etudiant_id' => 'required|exists:etudiants,id',
        ]);
        $parentEtudiant->update($validated);
        return redirect()->route('parents.index')->with('success', "Parent d'étudiant modifié avec succès.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParentEtudiant $parentEtudiant)
    {
        $parentEtudiant->delete();
        return redirect()->route('parents.index')->with('success', "Parent d'étudiant supprimé avec succès.");
    }
}
