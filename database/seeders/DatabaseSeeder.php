<?php

namespace Database\Seeders;

use App\Models\TypeCours;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call(NiveauSeeder::class);
        // $this->call(StatutSeeder::class);
        // $this->call(TypeCoursSeeder::class);
        // $this->call(EtudiantSeeder::class);
        // $this->call(ParentModelSeeder::class);
         $this->call(SeanceSeeder::class);

    }
}
