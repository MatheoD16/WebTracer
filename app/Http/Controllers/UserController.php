<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Scene;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profil($id){
        $scenes = Scene::select('scenes.*')
            ->leftJoin('favoris', 'scenes.id', '=', 'favoris.id_scene')
            ->where('favoris.id_utilisateur', intval($id))
            ->get();
        info($scenes);
        $commentaires = Commentaire::select('commentaires.*', DB::raw('scenes.nom AS nom_scene'))
            ->leftJoin('scenes', 'scenes.id', '=', 'commentaires.id_scene')
            ->where('commentaires.id_utilisateur', intval($id))
            ->get();
        return view('user.profil', ['title'=>'Profil', 'scenes'=>$scenes, 'commentaires' => $commentaires]);
    }

    public function changeAvatar(Request $request, $id)
    {
        if ($request->hasFile('document') && $request->file('document')->isValid()) {
            $file = $request->file('document');
            $nom = 'image';
            $now = time();
            $nom = sprintf("%s_%d.%s", $nom, $now, $file->extension());
            $file->storeAs('images', $nom);

            $user = User::find($id);
            $user->avatar = $nom;

            $user->save();
        }

        return redirect()->route('user.profil', ['id'=>$id]);
    }
}
