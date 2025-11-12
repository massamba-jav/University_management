<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Professeur>
 */
class ProfesseurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $grades = ['Assistant', 'Maître', 'Maître de Conférences', 'Professeur'];

        return [
            'nom' => fake()->lastName(),
            'prenom' => fake()->firstName(),
            'grade' => fake()->randomElement($grades),
            'salaire' => fake()->randomFloat(2, 800.00, 10000.00),
            'prime' => fake()->randomFloat(2, 0.00, 3000.00),
        ];
    }
}
