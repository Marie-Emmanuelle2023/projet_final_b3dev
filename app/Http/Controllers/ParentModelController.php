<?php

namespace App\Http\Controllers;

use App\Models\JustificationAbsence;
use App\Models\ParentModel;
use App\Models\Presence;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParentModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parentModels = ParentModel::with('user')->get();
        return view('parent_models.index', compact('parentModels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('parent_models.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        ParentModel::create($validated);
        return redirect()->route('parent_models.index')->with('success', "Parent ajouté avec succès.");
    }

    /**
     * Display the specified resource.
     */
    public function show(ParentModel $parentModel)
    {
        $parentModel->load('user');
        return view('parent_models.show', compact('parentModel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParentModel $parentModel)
    {
        $users = User::all();
        return view('parent_models.edit', compact('parentModel', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ParentModel $parentModel)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        $parentModel->update($validated);
        return redirect()->route('parent_models.index')->with('success', "Parent modifié avec succès.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParentModel $parentModel)
    {
        $parentModel->delete();
        return redirect()->route('parent_models.index')->with('success', "Parent supprimé avec succès.");
    }

    public function enfants()
    {
        $parent = Auth::user()->parentModel;
        $enfants = $parent->etudiants()->with('user')->get();

        return view('parents.enfants', compact('enfants'));
    }

    public function absences(Request $request)
    {
        $parent = Auth::user()->parentModel;
        $enfants = $parent->etudiants()->with('user')->get();

        $selectedChildId = $request->input('etudiant_id') ?? $enfants->first()?->id;

        $absences = Presence::where('etudiant_id', $selectedChildId)
            ->where('statut_id', 2)
            ->with('seance.module')
            ->latest()
            ->get();

        return view('parents.absences', compact('absences', 'enfants', 'selectedChildId'));
    }

    public function justifications(Request $request)
    {
        $parent = Auth::user()->parentModel;
        $enfants = $parent->etudiants()->with('user')->get();

        $selectedChildId = $request->input('etudiant_id') ?? $enfants->first()?->id;

        $justifications = JustificationAbsence::where('etudiant_id', $selectedChildId)
            ->with('presence.seance.module')
            ->latest()
            ->get();


        return view('parents.justifications', compact('justifications', 'enfants', 'selectedChildId'));
    }

    public function emploi(Request $request)
    {
        $parent = Auth::user()->parentModel;

        // Liste des enfants liés à ce parent
        $enfants = $parent->etudiants()->with('user')->get();

        // Si aucun enfant lié
        if ($enfants->isEmpty()) {
            return view('parents.emploi', ['enfants' => collect(), 'seances' => collect(), 'selectedChildId' => null]);
        }

        // Enfant sélectionné dans le menu déroulant ou premier par défaut
        $selectedChildId = $request->get('etudiant_id') ?? $enfants->first()->id;

        // On récupère la classe de cet enfant
        $classeId = \App\Models\Etudiant::find($selectedChildId)?->classe_id;

        // Séances de cette classe pendant la semaine actuelle
        $seances = \App\Models\Seance::with(['module', 'typeCours'])
            ->where('classe_id', $classeId)
            ->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
            ->orderBy('date')
            ->get();

        return view('parents.emploi', [
            'enfants' => $enfants,
            'seances' => $seances,
            'selectedChildId' => $selectedChildId,
        ]);
    }
}
