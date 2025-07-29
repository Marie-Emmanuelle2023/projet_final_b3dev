<?php

namespace App\Http\Controllers;

use App\Models\Seance;
use App\Models\TypeCours;
use App\Models\Classe;
use App\Models\EmploiDuTemps;
use App\Models\Module;
use App\Models\Professeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'professeur') {
            $moduleIds = $user->modules->pluck('id');
            $seances = Seance::with(['typeCours', 'classe', 'emploiDuTemps', 'module'])
                ->whereIn('module_id', $moduleIds)
                ->get();
        } else {
            $seances = Seance::with(['typeCours', 'classe', 'emploiDuTemps', 'module'])->get();
            $professeurs = Professeur::with('user')->get();
        }
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
        $professeurs = Professeur::with('user')->get();
        return view('seances.create', compact('typeCours', 'classes', 'emplois', 'modules', 'professeurs'));
    }

    /**
     * Store a newly created resource in storage.
     */

public function store(Request $request)
{
    // On récupère l'objet TypeCours pour en extraire son nom
    $typeCoursId = $request->input('type_cours_id');
    $typeCours = TypeCours::find($typeCoursId);

    // On détermine si le professeur est requis ou pas
    // Remplace 'nom' par 'libelle' si ta colonne s'appelle comme ça
    $coursSansProf = ['e-learning', 'workshop'];
    $isProfRequired = !in_array(strtolower(optional($typeCours)->nom), $coursSansProf);

    // Validation des champs
    $validated = $request->validate([
        'date' => 'required|date',
        'salle' => 'required|string|max:255',
        'type_cours_id' => 'required|exists:type_cours,id',
        'classe_id' => 'required|exists:classes,id',
        'emploi_du_temps_id' => 'required|exists:emploi_du_temps,id',
        'module_id' => 'required|exists:modules,id',
        'professeur_id' => [$isProfRequired ? 'required' : 'nullable', 'exists:professeurs,id'],
    ]);

    // Création de la séance
    Seance::create($validated);

    return redirect()->route('seances.index')->with('success', 'Séance créée avec succès.');
}




    /**
     * Display the specified resource.
     */
    public function show(Seance $seance)
    {
        $user = Auth::user();
        if ($user->role === 'professeur') {
            $moduleIds = $user->modules->pluck('id');
            if (!$moduleIds->contains($seance->module_id)) {
                abort(403);
            }
        }
        $seance->load(['typeCours', 'classe', 'emploiDuTemps', 'module']);
        return view('seances.show', compact('seance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seance $seance)
    {
        $user = Auth::user();
        if ($user->role === 'professeur') {
            $moduleIds = $user->modules->pluck('id');
            if (!$moduleIds->contains($seance->module_id)) {
                abort(403);
            }
        }
        $typeCours = TypeCours::all();
        $classes = Classe::all();
        $emplois = EmploiDuTemps::all();
        $modules = Module::all();
        $professeurs = Professeur::with('user')->get();
        return view('seances.edit', compact('seance', 'typeCours', 'classes', 'emplois', 'modules', 'professeurs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seance $seance)
    {
        $user = Auth::user();
        if ($user->role === 'professeur') {
            $moduleIds = $user->modules->pluck('id');
            if (!$moduleIds->contains($seance->module_id)) {
                abort(403);
            }
        }
        $validated = $request->validate([
            'date' => 'required|date',
            'salle' => 'required|string|max:255',
            'type_cours_id' => 'required|exists:type_cours,id',
            'classe_id' => 'required|exists:classes,id',
            'emploi_du_temps_id' => 'required|exists:emploi_du_temps,id',
            'module_id' => 'required|exists:modules,id',
            'professeur_id' => 'required|exists:professeurs,id',
        ]);

        $seance->update($validated);

        return redirect()->route('seances.index')->with('success', 'Séance modifiée avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seance $seance)
    {
        $user = Auth::user();
        if ($user->role === 'professeur') {
            $moduleIds = $user->modules->pluck('id');
            if (!$moduleIds->contains($seance->module_id)) {
                abort(403);
            }
        }
        $seance->delete();
        return redirect()->route('seances.index')->with('success', 'Séance supprimée avec succès.');
    }
}
