<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\EmploiDuTemps;
use App\Models\Seance;
use Illuminate\Support\Facades\Auth;

class EmploiDuTempsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $emplois = collect(); // valeur par défaut

        if ($user->role->libelle === 'coordinateur') {
            // Filtrage par classe (si filtre actif)
            $classeId = $request->input('classe_id');

            $query = EmploiDuTemps::with([
                'classe',
                'seances' => function ($q) {
                    $q->with(['module', 'typeCours', 'professeur.user'])->orderBy('date', 'asc');
                }
            ]);


            if ($classeId) {
                $query->where('classe_id', $classeId);
            }

            $emplois = $query->get();
            $classes = Classe::all(); // Pour le select de filtrage

            return view('emploi_du_temps.index', compact('emplois', 'classes', 'classeId'));
        } elseif ($user->role->libelle === 'professeur') {
            // Récupérer uniquement les emplois où il y a ses séances
            $emplois = EmploiDuTemps::whereHas('seances', function ($q) use ($user) {
                $q->where('professeur_id', $user->id);
            })->with(['classe', 'seances'])->get();
        } elseif ($user->role->libelle === 'etudiant') {
            $etudiant = $user->etudiant;
            $emplois = EmploiDuTemps::where('classe_id', $etudiant->classe_id)
                ->with(['classe', 'seances'])->get();
        } elseif ($user->role->libelle === 'parent') {
            $etudiant = $user->parentEtudiant->etudiant;
            $emplois = EmploiDuTemps::where('classe_id', $etudiant->classe_id)
                ->with(['classe', 'seances'])->get();
        }

        return view('emploi_du_temps.index', compact('emplois'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classe::all();
        return view('emploi_du_temps.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'classe_id' => 'required|exists:classes,id',
        ]);
        EmploiDuTemps::create($validated);
        return redirect()->route('emploi_du_temps.index')->with('success', 'Emploi du temps créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmploiDuTemps $emploiDuTemps)
    {
        $emploiDuTemps->load(['classe', 'seances.typeCours', 'seances.module']);
        return view('emploi_du_temps.show', compact('emploiDuTemps'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmploiDuTemps $emploiDuTemps)
    {
        $classes = Classe::all();
        return view('emploi_du_temps.edit', compact('emploiDuTemps', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmploiDuTemps $emploiDuTemps)
    {
        $validated = $request->validate([
            'classe_id' => 'required|exists:classes,id',
        ]);
        $emploiDuTemps->update($validated);
        return redirect()->route('emploi_du_temps.index')->with('success', 'Emploi du temps modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmploiDuTemps $emploiDuTemps)
    {
        $emploiDuTemps->delete();
        return redirect()->route('emploi_du_temps.index')->with('success', 'Emploi du temps supprimé avec succès.');
    }
}
