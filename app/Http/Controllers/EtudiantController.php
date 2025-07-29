<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudiants = Etudiant::with(['user', 'classe'])->orderByDesc('id')->get();
        return view('etudiants.index', compact('etudiants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::orderBy('nom')->get();
        $classes = Classe::orderBy('nom')->get();
        return view('etudiants.create', compact('users', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'classe_id' => 'required|exists:classes,id',
            'is_dropped' => 'required|boolean',
        ]);
        Etudiant::create($validated);
        return redirect()->route('etudiants.index')->with('success', 'Étudiant ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Etudiant $etudiant)
    {
        $etudiant->load(['user', 'classe']);
        return view('etudiants.show', compact('etudiant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etudiant $etudiant)
    {
        $users = User::orderBy('nom')->get();
        $classes = Classe::orderBy('nom')->get();
        return view('etudiants.edit', compact('etudiant', 'users', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'classe_id' => 'required|exists:classes,id',
            'is_dropped' => 'required|boolean',
        ]);
        $etudiant->update($validated);
        return redirect()->route('etudiants.index')->with('success', 'Étudiant modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();
        return redirect()->route('etudiants.index')->with('success', 'Étudiant supprimé avec succès.');
    }

    public function absences()
    {
        $etudiant = Auth::user()->etudiant;
        $absences = $etudiant->presences()
            ->with('seance.module', 'seance.classe', 'seance.typeCours')
            ->where('statut_id', 2)
            ->latest()
            ->get();

        return view('etudiants.absences', compact('absences'));
    }


    public function justifications()
    {
        $etudiant = Auth::user()->etudiant;
        $justifications = $etudiant->presences()
            ->whereHas('justification')
            ->with('justification', 'seance.module')
            ->latest()
            ->get();

        return view('etudiants.justifications', compact('justifications'));
    }

    public function emploi()
    {
        $etudiant = Auth::user()->etudiant;
        $seances = \App\Models\Seance::with(['module', 'typeCours'])
            ->where('classe_id', $etudiant->classe_id)
            ->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
            ->orderBy('date')
            ->get();

        return view('etudiants.emploi', compact('seances'));
    }
}
