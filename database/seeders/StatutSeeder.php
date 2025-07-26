<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       \App\Models\Statut::insert([
            ['libelle' => 'Présent'],
            ['libelle' => 'Absent'],
            ['libelle' => 'En retard'],
        ]);
    }
}
