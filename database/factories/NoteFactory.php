<?php

namespace Database\Factories;

use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */



    public function definition(): array
    {
        $valide = true;
        $notes = Note::all();
        do {

            $id_user = random_int(1, 10);
            $id_scene = random_int(1, 10);
            foreach ($notes as $note) {
                if ($note->id_utilisateur == $id_user && $note->id_scene == $id_scene) {
                    $valide = false;
                    break;
                }
            }
        }while(! $valide);
        return [
            "note"=>random_int(0,5),
            "id_utilisateur"=>$id_user,
            "id_scene"=>$id_scene
        ];
    }
}
