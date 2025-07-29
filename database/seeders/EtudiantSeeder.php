<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EtudiantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $noms = [
            'Kouadio', 'Konan', 'Koffi', 'Yao', 'Traoré', 'Soro', 'Bamba', 'Ouattara', 'Kouakou', 'Kouassi',
            'Zoungrana', 'Kouamé', 'Kouadio', 'Kouassi', 'Kouakou', 'Koffi', 'Yao', 'Koné', 'Diabaté', 'Fofana'
        ];
        $prenoms = [
            'Kevin', 'Cédric', 'Marie-Laure', 'Prisca', 'Wilfried', 'Christelle', 'Arsène', 'Désiré', 'Tatiana', 'Jean-Marc',
            'Stéphane', 'Josué', 'Ange', 'Emmanuelle', 'Ruth', 'Brice', 'Nadine', 'Romaric', 'Esther', 'Elie',
            'Grace', 'Junior', 'Melissa', 'Boris', 'Inès', 'Axel', 'Kelly', 'Mickael', 'Sandy', 'Nathanaël'
        ];

        $classes = \App\Models\Classe::all();
        // Récupère le dernier identifiant étudiant existant
        $lastUser = \App\Models\User::where('identifiant', 'like', 'IF-Etudiant00%')->orderByDesc('identifiant')->first();
        $lastNum = 0;
        if ($lastUser) {
            // extrait le numéro à la fin de l'identifiant
            if (preg_match('/IF-Etudiant00(\d+)/', $lastUser->identifiant, $matches)) {
                $lastNum = (int)$matches[1];
            }
        }
        foreach (range(1, 20) as $i) {
            $num = $lastNum + $i;
            $nom = $noms[array_rand($noms)];
            $prenom = $prenoms[array_rand($prenoms)];
            $identifiant = 'IF-Etudiant00' . $num;
            $motdepasse = 'etudiant00' . $num;
            $classe = $classes->random();
            $user = \App\Models\User::create([
                'nom' => $nom,
                'prenom' => $prenom,
                'identifiant' => $identifiant,
                'password' => bcrypt($motdepasse),
                'role_id' => 4
            ]);
            \App\Models\Etudiant::create([
                'user_id' => $user->id,
                'classe_id' => $classe->id,
                'is_dropped' => false
            ]);
        }
    }
}
