<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParentModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $etudiants = \App\Models\Etudiant::with('user')->get();
        $parents = [];

        // Récupère le dernier identifiant parent existant
        $lastUser = \App\Models\User::where('identifiant', 'like', 'IF-Parent00%')->orderByDesc('identifiant')->first();
        $lastNum = 0;
        if ($lastUser) {
            if (preg_match('/IF-Parent00(\d+)/', $lastUser->identifiant, $matches)) {
                $lastNum = (int)$matches[1];
            }
        }
        $numParent = $lastNum;
        foreach ($etudiants as $etudiant) {
            $nomFamille = $etudiant->user->nom;
            // Si un parent existe déjà pour ce nom de famille, on le réutilise
            if (!isset($parents[$nomFamille])) {
                $numParent++;
                $identifiant = 'IF-Parent00' . $numParent;
                $motdepasse = 'parent00' . $numParent;
                $parentUser = \App\Models\User::create([
                    'nom' => $nomFamille,
                    'prenom' => fake()->firstName(),
                    'identifiant' => $identifiant,
                    'password' => bcrypt($motdepasse),
                    'role_id' => 5
                ]);
                $parentModel = \App\Models\ParentModel::create([
                    'user_id' => $parentUser->id
                ]);
                $parents[$nomFamille] = $parentModel;
            }
            // Associe l'étudiant au parent
            if (class_exists('App\\Models\\ParentEtudiant')) {
                \App\Models\ParentEtudiant::create([
                    'parent_model_id' => $parents[$nomFamille]->id,
                    'etudiant_id' => $etudiant->id
                ]);
            }
        }
    }
}
