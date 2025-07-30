<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\JustificationAbsence;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JustificationAbsenceController extends Controller
{
    public function index()
    {
        $justifications = JustificationAbsence::with('etudiant.user', 'presence.seance')->get();
        return view('justifications.index', compact('justifications'));
    }

    public function create()
    {
        $user = Auth::user();
        $role = $user->role->libelle;

        $presences = Presence::where('statut_id', 2)->with('etudiant.user', 'seance')->get(); // uniquement les absents
        $etudiants = [];

        if ($role === 'coordinateur') {
            $etudiants = Etudiant::whereHas('presences', function ($q) {
                $q->where('statut_id', 2); // 2 = absent
            })->with('user')->get();
        }

        return view('justifications.create', compact('etudiants', 'presences', 'role'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $role = $user->role->libelle;

        $rules = [
            'motif' => 'required|string|max:255',
            'preuve' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'date' => 'required|date',
            'presence_id' => 'required|exists:presences,id',
        ];

        if ($role === 'coordinateur') {
            $rules['etudiant_id'] = 'required|exists:etudiants,id';
        }

        $validated = $request->validate($rules);

        if ($role === 'parent') {
            $etudiant = $user->parentModel->etudiants->first();
            if (!$etudiant) {
                return redirect()->back()->withErrors(['etudiant_id' => 'Aucun enfant associé.']);
            }
            $validated['etudiant_id'] = $etudiant->id;
        }

        if ($request->hasFile('preuve')) {
            $file = $request->file('preuve');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('preuves'), $filename);
            $validated['preuve'] = 'preuves/' . $filename;
        }

        JustificationAbsence::create($validated);

        return redirect()->route('justifications.index')->with('success', 'Justification enregistrée avec succès.');
    }


    public function show(JustificationAbsence $justification)
    {
        $justification->load('etudiant.user', 'presence.seance');
        return view('justifications.show', compact('justification'));
    }

    public function edit(JustificationAbsence $justification)
    {
        $user = Auth::user();
        $role = $user->role->libelle;

        $etudiants = [];
        if ($role === 'coordinateur') {
            $etudiants = Etudiant::with('user')->get();
        }

        $presences = Presence::with('seance')->get();

        return view('justifications.edit', compact('justification', 'etudiants', 'presences', 'role'));
    }

    public function update(Request $request, JustificationAbsence $justification)
    {
        $user = Auth::user();
        $role = $user->role->libelle;

        $rules = [
            'motif' => 'required|string|max:255',
            'preuve' => 'nullable|string|max:255',
            'date' => 'required|date',
            'presence_id' => 'required|exists:presences,id',
        ];

        if ($role === 'coordinateur') {
            $rules['etudiant_id'] = 'required|exists:etudiants,id';
        }

        $validated = $request->validate($rules);

        if ($role === 'parent') {
            $etudiant = $user->parentModel->etudiants->first();
            if (!$etudiant) {
                return redirect()->back()->withErrors(['etudiant_id' => 'Aucun enfant associé.']);
            }
            $validated['etudiant_id'] = $etudiant->id;
        }

        $justification->update($validated);

        return redirect()->route('justifications.index')->with('success', 'Justification mise à jour avec succès.');
    }

    public function destroy(JustificationAbsence $justification)
    {
        $justification->delete();
        return redirect()->route('justifications.index')->with('success', 'Justification supprimée.');
    }
}
