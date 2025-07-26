<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfesseurModule;
use App\Models\Professeur;
use App\Models\Module;

class ProfesseurModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professeurModules = ProfesseurModule::with(['professeur.user', 'module'])->get();
        return view('professeur_modules.index', compact('professeurModules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $professeurs = Professeur::with('user')->get();
        $modules = Module::all();
        return view('professeur_modules.create', compact('professeurs', 'modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'professeur_id' => 'required|exists:professeurs,id',
            'module_id' => 'required|exists:modules,id',
        ]);
        ProfesseurModule::create($validated);
        return redirect()->route('professeur_modules.index')->with('success', 'Affectation créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProfesseurModule $professeurModule)
    {
        $professeurModule->load(['professeur.user', 'module']);
        return view('professeur_modules.show', compact('professeurModule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProfesseurModule $professeurModule)
    {
        $professeurs = Professeur::with('user')->get();
        $modules = Module::all();
        return view('professeur_modules.edit', compact('professeurModule', 'professeurs', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProfesseurModule $professeurModule)
    {
        $validated = $request->validate([
            'professeur_id' => 'required|exists:professeurs,id',
            'module_id' => 'required|exists:modules,id',
        ]);
        $professeurModule->update($validated);
        return redirect()->route('professeur_modules.index')->with('success', 'Affectation modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfesseurModule $professeurModule)
    {
        $professeurModule->delete();
        return redirect()->route('professeur_modules.index')->with('success', 'Affectation supprimée avec succès.');
    }
}
