<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class NoteController extends Controller
{
    public function addNote(Request $request,$id, $user_id){
        $note = new Note();
        $note->id_utilisateur = $user_id;
        $note->id_scene = $id;
        $note->note = $request->note;
        $note->save();

        return redirect()->route('scenes.show',['id'=>$id]);
    }

    public function updateNote(Request $request, $id, $user_id){
        $this->validate($request, ['note'=>'required']);

          $note =  Note::where('id_utilisateur','=',intval($user_id))
              ->where('id_scene','=',intval($id))
              ->update(['note'=>$request->note]);

          return redirect()->route('scenes.show',['id'=>$id]);

    }


    public function deleteNote($id,$user_id){
        $note = Note::where('id_utilisateur','=',intval($user_id))
            ->where('id_scene','=',intval($id))
            ->delete();

        return redirect()->route('scenes.show',['id'=>$id]);
    }
}
