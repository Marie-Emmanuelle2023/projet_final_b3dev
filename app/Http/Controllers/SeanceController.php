<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSeanceRequest;
use App\Http\Requests\UpdateSeanceRequest;
use App\Models\Seance;
use App\Models\TypeCours;
use App\Models\Classe;
use App\Models\EmploiDuTemps;
use App\Models\Module;

class SeanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seances = Seance::with(['typeCours', 'classe', 'emploiDuTemps', 'module'])->get();
        return view('seances.index', compact('seances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $typeCours = TypeCours::all();
        $classes = Classe::all();
        $emplois = EmploiDuTemps::all();
        $modules = Module::all();
        return view('seances.create', compact('typeCours', 'classes', 'emplois', 'modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSeanceRequest $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'salle' => 'required|string|max:255',
            'type_cours_id' => 'required|exists:type_cours,id',
            'classe_id' => 'required|exists:classes,id',
            'emploi_du_temps_id' => 'required|exists:emploi_du_temps,id',
            'module_id' => 'required|exists:modules,id',
        ]);
        Seance::create($validated);
        return redirect()->route('seances.index')->with('success', 'Séance créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Seance $seance)
    {
        $seance->load(['typeCours', 'classe', 'emploiDuTemps', 'module']);
        return view('seances.show', compact('seance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seance $seance)
    {
        $typeCours = TypeCours::all();
        $classes = Classe::all();
        $emplois = EmploiDuTemps::all();
        $modules = Module::all();
        return view('seances.edit', compact('seance', 'typeCours', 'classes', 'emplois', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSeanceRequest $request, Seance $seance)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'salle' => 'required|string|max:255',
            'type_cours_id' => 'required|exists:type_cours,id',
            'classe_id' => 'required|exists:classes,id',
            'emploi_du_temps_id' => 'required|exists:emploi_du_temps,id',
            'module_id' => 'required|exists:modules,id',
        ]);
        $seance->update($validated);
        return redirect()->route('seances.index')->with('success', 'Séance modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seance $seance)
    {
        $seance->delete();
        return redirect()->route('seances.index')->with('success', 'Séance supprimée avec succès.');
    }
}
