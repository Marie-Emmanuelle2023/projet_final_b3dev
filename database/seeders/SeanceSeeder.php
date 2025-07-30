<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // On récupère toutes les classes
        $classes = \App\Models\Classe::all();
        $modules = \App\Models\Module::all();
        $professeurs = \App\Models\Professeur::all();
        $types = \App\Models\TypeCours::all();
        $emplois = \App\Models\EmploiDuTemps::all();

        foreach ($classes as $classe) {
            $emploi = $emplois->where('classe_id', $classe->id)->first();
            if (!$emploi) continue;

            // Pour chaque type de cours, on génère 5 séances à 9h et 5 à 14h
            foreach ($types as $type) {
                for ($i = 1; $i <= 5; $i++) {
                    \App\Models\Seance::create([
                        'date' => now()->addDays($i)->setTime(9, 0),
                        'salle' => 'Salle ' . rand(1, 10),
                        'type_cours_id' => $type->id,
                        'classe_id' => $classe->id,
                        'emploi_du_temps_id' => $emploi->id,
                        'module_id' => $modules->random()->id ?? 1,
                        'professeur_id' => $professeurs->random()->id ?? 1,
                    ]);
                }
                for ($i = 1; $i <= 5; $i++) {
                    \App\Models\Seance::create([
                        'date' => now()->addDays($i)->setTime(14, 0),
                        'salle' => 'Salle ' . rand(1, 10),
                        'type_cours_id' => $type->id,
                        'classe_id' => $classe->id,
                        'emploi_du_temps_id' => $emploi->id,
                        'module_id' => $modules->random()->id ?? 1,
                        'professeur_id' => $professeurs->random()->id ?? 1,
                    ]);
                }
            }
        }
    }
}
