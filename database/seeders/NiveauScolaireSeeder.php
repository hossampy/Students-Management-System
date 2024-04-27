<?php

namespace Database\Seeders;

use App\Models\NiveauScolaire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NiveauScolaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
            NiveauScolaire::create(['nom' => '6ème']);
            NiveauScolaire::create(['nom' => '5ème']);
            NiveauScolaire::create(['nom' => '4ème']);
            NiveauScolaire::create(['nom' => '3ème']);


    }
}
