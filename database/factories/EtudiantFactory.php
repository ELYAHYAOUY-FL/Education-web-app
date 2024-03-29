<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etudiant>
 */
class EtudiantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nom" => $this->faker->name(),
            "prenom" => $this->faker->firstName(),
            "sexe"=> ["M", "F"][rand(0,1)],
            "age" => rand(5, 13),
            "niveau_scolaire_id" => rand(1, 6),
            "date_naissance" => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
