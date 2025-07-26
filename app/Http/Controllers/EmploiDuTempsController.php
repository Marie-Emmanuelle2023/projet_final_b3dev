<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\EmploiDuTemps;
use App\Models\Seance;

class EmploiDuTempsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emplois = EmploiDuTemps::with(['classe', 'seances'])->get();
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
