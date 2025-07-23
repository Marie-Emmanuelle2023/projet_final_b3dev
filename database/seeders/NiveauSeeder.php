<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NiveauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Niveau::insert([
            ['nom' => 'Bachelor 1'],
            ['nom' => 'Bachelor 2'],
            ['nom' => 'Bachelor 3'],
        ]);
    }
}
