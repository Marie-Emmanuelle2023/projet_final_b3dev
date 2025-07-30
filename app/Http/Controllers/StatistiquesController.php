<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Classe;
use App\Models\Module;
use App\Models\Niveau;
use App\Models\Presence;
use App\Models\Seance;
use App\Models\TypeCours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatistiquesController extends Controller
{
    public function tauxPresenceEtudiants()
    {
        $etudiants = Etudiant::with('user')->get();
        $data = [];

        foreach ($etudiants as $etudiant) {
            $totalSeances = Presence::where('etudiant_id', $etudiant->id)->count();
            $presences = Presence::where('etudiant_id', $etudiant->id)->where('statut_id', 1)->count();

            $taux = $totalSeances > 0 ? ($presences / $totalSeances) * 100 : 0;

            $couleur = match (true) {
                $taux >= 70 => '#006400',
                $taux >= 50.1 => '#32CD32',
                $taux >= 30.1 => '#FFA500',
                default => '#FF0000'
            };

            $data[] = [
                'etudiant' => $etudiant->user->prenom . ' ' . $etudiant->user->nom,
                'taux' => round($taux, 2),
                'color' => $couleur,
            ];
        }

        return response()->json($data);
    }

    public function tauxPresenceParClasse()
    {
        $classes = Classe::with('etudiants')->get();
        $data = [];

        foreach ($classes as $classe) {
            $etudiants = $classe->etudiants;
            $totalPresences = 0;
            $totalSeances = 0;

            foreach ($etudiants as $etudiant) {
                $totalPresences += Presence::where('etudiant_id', $etudiant->id)->where('statut_id', 1)->count();
                $totalSeances += Presence::where('etudiant_id', $etudiant->id)->count();
            }

            $taux = $totalSeances > 0 ? ($totalPresences / $totalSeances) * 100 : 0;

            $data[] = [
                'classe' => $classe->nom,
                'taux' => round($taux, 2),
            ];
        }

        return response()->json($data);
    }

    public function tauxPresenceParNiveau()
    {
        $niveaux = Niveau::with('classes.etudiants')->get();
        $data = [];

        foreach ($niveaux as $niveau) {
            $etudiants = $niveau->classes->flatMap->etudiants;
            $totalPresences = 0;
            $totalSeances = 0;

            foreach ($etudiants as $etudiant) {
                $totalPresences += Presence::where('etudiant_id', $etudiant->id)->where('statut_id', 1)->count();
                $totalSeances += Presence::where('etudiant_id', $etudiant->id)->count();
            }

            $taux = $totalSeances > 0 ? ($totalPresences / $totalSeances) * 100 : 0;

            $data[] = [
                'niveau' => $niveau->nom,
                'taux' => round($taux, 2),
            ];
        }

        return response()->json($data);
    }

    public function volumeCoursParType()
    {
        $types = TypeCours::withCount('seances')->get();

        $data = $types->map(fn($type) => [
            'type' => $type->libelle,
            'volume' => $type->seances_count
        ]);

        return response()->json($data);
    }

    public function volumeCumulParTrimestreEtNiveau()
    {
        $niveaux = Niveau::with('classes.seances')->get();
        $data = [];

        foreach ($niveaux as $niveau) {
            $trimestres = [1 => 0, 2 => 0];

            foreach ($niveau->classes as $classe) {
                foreach ($classe->seances as $seance) {
                    $mois = \Carbon\Carbon::parse($seance->date)->month;

                    if ($mois >= 1 && $mois <= 3) {
                        $trimestres[1]++;
                    } elseif ($mois >= 4 && $mois <= 6) {
                        $trimestres[2]++;
                    }
                }
            }

            $data[] = [
                'niveau' => $niveau->nom,
                'trim1' => $trimestres[1],
                'trim2' => $trimestres[2]
            ];
        }

        return response()->json($data);
    }


    // Étudiants à "dropper" automatiquement (< 30% de présence)
    public function listeEtudiantsDroppés()
    {
        $droppés = [];

        $etudiants = Etudiant::all();

        foreach ($etudiants as $etudiant) {
            $modules = Presence::where('etudiant_id', $etudiant->id)
                ->with('seance.module')
                ->get()
                ->groupBy(fn($p) => $p->seance->module_id);

            foreach ($modules as $moduleId => $presences) {
                $total = $presences->count();
                $present = $presences->where('statut_id', 1)->count();
                $taux = $total > 0 ? ($present / $total) * 100 : 0;

                if ($taux < 30) {
                    $droppés[] = [
                        'etudiant' => $etudiant->user->prenom . ' ' . $etudiant->user->nom,
                        'module' => $presences->first()->seance->module->nom,
                        'taux' => round($taux, 2)
                    ];
                }
            }
        }

        return response()->json($droppés);
    }
}
