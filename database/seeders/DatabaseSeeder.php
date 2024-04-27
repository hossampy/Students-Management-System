<?php

namespace Database\Seeders;

use App\Models\etudiant;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\EtudiantFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       $this->call(NiveauScolaireSeeder::class);
       etudiant::factory(10)->create();
    }
}
