<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Departement;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Filiere>
 */
class FiliereFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => ucfirst(fake()->unique()->word()),
            'droit_inscription' => fake()->randomFloat(2, 50, 500), // between 50.00 and 500.00
            'mensualite' => fake()->randomFloat(2, 100, 1500),     // between 100.00 and 1500.00
            'departement_id' => (Departement::count() > 0) ? Departement::pluck('id')->random() : Departement::factory(),
        ];
    }
}
