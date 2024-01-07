<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commentaire>
 */
class CommentaireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createAt = $this->faker->dateTimeInInterval(
            $startDate = '-6 months',
            $interval = '+ 180 days',
        );

        return [
            "titre"=>fake()->word(),
            "texte"=>fake()->paragraph(),
            "id_utilisateur"=>random_int(1,10),
            "id_scene"=>random_int(1,10)
        ];
    }
}
