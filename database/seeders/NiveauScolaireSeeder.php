<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NiveauScolaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NiveauScolaire::created(["nom"=>"1éme"]);
        NiveauScolaire::created(["nom"=>"2éme"]);
        NiveauScolaire::created(["nom"=>"3éme"]);
        NiveauScolaire::created(["nom"=>"4éme"]);
        NiveauScolaire::created(["nom"=>"5éme"]);
        NiveauScolaire::created(["nom"=>"6éme"]);
    }
}
