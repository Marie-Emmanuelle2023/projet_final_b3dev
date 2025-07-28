<?php

namespace App\Http\Controllers;

use App\Models\Annee;
use App\Models\Classe;
use App\Models\Coordinateur;
use App\Models\Etudiant;
use App\Models\JustificationAbsence;
use App\Models\Module;
use App\Models\Niveau;
use App\Models\ParentModel;
use App\Models\Presence;
use App\Models\Professeur;
use App\Models\ProfesseurModule;
use App\Models\Seance;
use App\Models\TypeCours;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $role = $user->role->libelle;
        if ($role === 'admin') {
            $usersCount = User::count();
            $classesCount = Classe::count();
            $professeursCount = Professeur::count();
            $coordinateursCount = Coordinateur::count();
            $parentsCount = ParentModel::count();
            $etudiantsCount = Etudiant::count();
            $modulesCount = Module::count();
            $typeCoursCount = TypeCours::count();
            $niveauxCount = Niveau::count();
            $anneesCount = Annee::count();
            return view('dashboard-admin', compact(
                'usersCount',
                'classesCount',
                'professeursCount',
                'coordinateursCount',
                'parentsCount',
                'etudiantsCount',
                'modulesCount',
                'typeCoursCount',
                'niveauxCount',
                'anneesCount'
            ));
        }
        if ($role === 'coordinateur') {
            $classesCount = Classe::count();
            $modulesCount = Module::count();
            $etudiantsCount = Etudiant::count();
            $justificationsCount = JustificationAbsence::count();
            $absencesCount = Presence::whereHas('statut', function ($query) {
                $query->where('libelle', 'absent');
            })->count();
            $seancesThisWeekCount = Seance::whereBetween('date', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])->count();
            return view('dashboard-coordinateur', compact(
                'classesCount',
                'modulesCount',
                'etudiantsCount',
                'justificationsCount',
                'absencesCount',
                'seancesThisWeekCount'
            ));
        }
        if ($role === 'professeur') {
            $professeurId = $user->professeur->id ?? null;
            $moduleIds = ProfesseurModule::where('professeur_id', $professeurId)->pluck('module_id');
            $seanceIds = Seance::whereIn('module_id', $moduleIds)->pluck('id');
            $absencesCount = Presence::whereIn('seance_id', $seanceIds)->where('statut_id', 2)->count();
            $seancesCount = Seance::whereIn('id', $seanceIds)->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])->count();
            $modulesCount = $moduleIds->count();
            $seancesProchaines = Seance::whereIn('module_id', $moduleIds)
                ->where('date', '>=', now())
                ->orderBy('date')
                ->limit(5)
                ->with('module')
                ->get();

            return view('dashboard-professeur', compact('seancesCount', 'absencesCount', 'modulesCount', 'seancesProchaines'));
        }

        if ($role === 'etudiant') {
            $absencesCount = Presence::where('etudiant_id', $user->etudiant->id ?? null)->where('statut_id', 2)->count();
            $justificationsCount = JustificationAbsence::where('etudiant_id', $user->etudiant->id ?? null)->count();
            $modulesCount = Module::whereHas('etudiants', function ($q) use ($user) {
                $q->where('etudiant_id', $user->etudiant->id ?? null);
            })->count();
            return view('dashboard-etudiant', compact('absencesCount', 'justificationsCount', 'modulesCount'));
        }
        if ($role === 'parent') {
            $parent = $user->parentModel;
            $child = $parent ? $parent->etudiants->first() : null;
            $childAbsencesCount = $child ? Presence::where('etudiant_id', $child->id)->where('statut_id', 2)->count() : 0;
            $childJustificationsCount = $child ? JustificationAbsence::where('etudiant_id', $child->id)->count() : 0;
            $childModulesCount = $child ? Module::whereHas('etudiants', function ($q) use ($child) {
                $q->where('etudiant_id', $child->id);
            })->count() : 0;
            return view('dashboard-parent', compact('childAbsencesCount', 'childJustificationsCount', 'childModulesCount'));
        }
        abort(403);
    }
}
