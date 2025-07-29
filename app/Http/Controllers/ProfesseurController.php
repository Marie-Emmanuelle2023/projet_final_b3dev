<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Professeur;
use App\Models\Seance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Module;
use App\Models\Presence;
use App\Models\Statut;

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

    /**
     * Display the professor's schedule.
     */
    public function emploi()
    {
        $user = Auth::user();
        $professeur = $user->professeur;
        $profId = $user->professeur->id ?? null;

        $moduleIds = $professeur->modules->pluck('id');
        $seances = Seance::with(['module', 'classe', 'typeCours'])
            ->whereIn('module_id', $moduleIds)
            ->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
            ->orderBy('date')
            ->get();

        return view('professeurs.emploi', compact('seances'));
    }

    public function seances()
    {
        $user = Auth::user();
        $professeur = $user->professeur;

        if (!$professeur) {
            return redirect()->route('dashboard')->withErrors('Aucun professeur associé à ce compte.');
        }

        $moduleIds = $professeur->modules->pluck('id');

        $seances = Seance::with(['module', 'classe', 'typeCours'])
            ->whereIn('module_id', $moduleIds)
            ->orderBy('date')
            ->get();

        return view('professeurs.seances', compact('seances'));
    }


    public function modules()
    {
        $user = Auth::user();
        $professeur = $user->professeur;

        if (!$professeur) {
            abort(403, 'Aucun profil professeur lié à ce compte.');
        }

        $modules = $professeur->modules;

        return view('professeurs.modules', compact('modules'));
    }

    public function marquerPresence(Seance $seance)
    {
        $user = Auth::user();
        $professeur = $user->professeur;

        // Vérification que cette séance appartient bien à ce professeur
        if (!$professeur || !$seance || !$professeur->modules->contains($seance->module_id)) {
            abort(403, 'Accès non autorisé.');
        }

        $etudiants = $seance->classe->etudiants; // récupère les étudiants de la classe liée à cette séance
        $statuts = Statut::all();
        return view('professeurs.marquer', compact('seance', 'etudiants', 'statuts'));
    }

    public function enregistrerPresence(Request $request, Seance $seance)
    {
        $request->validate([
            'presences' => 'required|array',
        ]);

        foreach ($request->presences as $etudiantId => $statutId) {
            Presence::updateOrCreate(
                ['seance_id' => $seance->id, 'etudiant_id' => $etudiantId],
                ['statut_id' => $statutId]
            );
        }

        return redirect()->route('professeur.seances')->with('success', 'Présences enregistrées.');
    }
}
