<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Scene>
 */
class SceneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->word(),
            'equipe' => fake()->company(),
            'description' => fake()->paragraph(),
            'date_ajout' => fake()->dateTime(),
            'scene' => fake()->paragraph(),
            'lien_image' => fake()->imageUrl(),
            'lien_vignette' => fake()->imageUrl(),
            'lien_executable' => fake()->url(),
            'id_utilisateur' => random_int(1,10),
        ];
    }
}
