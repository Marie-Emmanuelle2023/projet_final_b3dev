<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\JustificationAbsence;
use Illuminate\Http\Request;

class JustificationAbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $justifications = JustificationAbsence::with('etudiant.user')->get();
        return view('justifications.index', compact('justifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $etudiants = Etudiant::with('user')->get();
        return view('justifications.create', compact('etudiants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'motif' => 'required|string|max:255',
            'preuve' => 'nullable|string|max:255',
            'date' => 'required|date',
        ]);
        JustificationAbsence::create($validated);
        return redirect()->route('justifications.index')->with('success', "Justification ajoutée avec succès.");
    }

    /**
     * Display the specified resource.
     */
    public function show(JustificationAbsence $justification)
    {
        $justification->load('etudiant.user');
        return view('justifications.show', compact('justification'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JustificationAbsence $justification)
    {
        $etudiants = Etudiant::with('user')->get();
        return view('justifications.edit', compact('justification', 'etudiants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JustificationAbsence $justification)
    {
        $validated = $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'motif' => 'required|string|max:255',
            'preuve' => 'nullable|string|max:255',
            'date' => 'required|date',
        ]);
        $justification->update($validated);
        return redirect()->route('justifications.index')->with('success', "Justification modifiée avec succès.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JustificationAbsence $justification)
    {
        $justification->delete();
        return redirect()->route('justifications.index')->with('success', "Justification supprimée avec succès.");
    }
}
