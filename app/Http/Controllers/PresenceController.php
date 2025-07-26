<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Presence;
use App\Models\Seance;
use App\Models\Statut;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presences = Presence::with(['etudiant.user', 'seance', 'statut'])->get();
        return view('presences.index', compact('presences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $etudiants = Etudiant::with('user')->get();
        $seances = Seance::all();
        $statuts = Statut::all();
        return view('presences.create', compact('etudiants', 'seances', 'statuts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'seance_id' => 'required|exists:seances,id',
            'statut_id' => 'required|exists:statuts,id',
        ]);
        Presence::create($validated);
        return redirect()->route('presences.index')->with('success', 'Présence ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Presence $presence)
    {
        $presence->load(['etudiant.user', 'seance', 'statut']);
        return view('presences.show', compact('presence'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presence $presence)
    {
        $etudiants = Etudiant::with('user')->get();
        $seances = Seance::all();
        $statuts = Statut::all();
        return view('presences.edit', compact('presence', 'etudiants', 'seances', 'statuts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Presence $presence)
    {
        $validated = $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'seance_id' => 'required|exists:seances,id',
            'statut_id' => 'required|exists:statuts,id',
        ]);
        $presence->update($validated);
        return redirect()->route('presences.index')->with('success', 'Présence modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presence $presence)
    {
        $presence->delete();
        return redirect()->route('presences.index')->with('success', 'Présence supprimée avec succès.');
    }
}
