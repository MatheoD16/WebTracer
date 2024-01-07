<?php

namespace Database\Factories;

use App\Models\Favoris;
use App\Models\Note;
use App\Models\Scene;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Favoris>
 */
class FavorisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $valide = true;
        $favoris = Favoris::all();
        do {
            $id_user = random_int(1, 10);
            $id_scene = random_int(1, 10);
            foreach ($favoris as $favori) {
                if ($favori->id_utilisateur == $id_user && $favori->id_scene == $id_scene) {
                    $valide = false;
                    break;
                }
            }
        }while(! $valide);

        return [
            'id_utilisateur' => $id_user,
            'id_scene' => $id_scene,
        ];
    }
}
