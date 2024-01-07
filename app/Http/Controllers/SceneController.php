<?php

namespace App\Http\Controllers;



use App\Models\Commentaire;
use App\Models\Favoris;
use App\Models\Note;
use App\Models\Scene;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class SceneController extends Controller
{

    public function index(Request $request) {
        $filterType = $request->input('filterType', 'equipe');
        $filterValue = $request->cookie('filterType', null);
        $cat = $request->input('equipe', 'All');
        $value = $request->cookie('equipe', null);

        if ($filterType === 'recent') {
            $scenes = Scene::select('scenes.*', DB::raw('IFNULL(AVG(notes.note), 0) AS avg_note'))
                ->leftJoin('notes', 'scenes.id', '=', 'notes.id_scene')  // Assurez-vous que 'scene_id' correspond à la clé étrangère
                ->groupBy('scenes.id')
                ->orderBy('create_at', 'desc')
                ->take(5)
                ->get();
            $cat = 'All';
        } else if($filterType === 'note') {

            $scenes = Scene::select('scenes.*', DB::raw('IFNULL(AVG(notes.note), 0) AS avg_note'))
                ->leftJoin('notes', 'scenes.id', '=', 'notes.id_scene')
                ->groupBy('scenes.id')
                ->orderByDesc('avg_note')
                ->take(5)
                ->get();
            $cat = 'All';
        } else{
            if (!isset($cat)) {
                if (!isset($value)) {
                    $scenes = Scene::select('scenes.*', DB::raw('IFNULL(AVG(notes.note), 0) AS avg_note'))
                        ->leftJoin('notes', 'scenes.id', '=', 'notes.id_scene')
                        ->groupBy('scenes.id')
                        ->get();                    $cat='All';
                    Cookie::expire('equipe');
                } else {
                    $scenes = Scene::select('scenes.*', DB::raw('IFNULL(AVG(notes.note), 0) AS avg_note'))
                        ->leftJoin('notes', 'scenes.id', '=', 'notes.id_scene')
                        ->where('equipe', $value)
                        ->groupBy('scenes.id')
                        ->get();
                    $cat = $value;
                    Cookie::queue('equipe', $cat, 10);
                }
            } else {
                if ($cat == "All") {
                    $scenes = Scene::select('scenes.*', DB::raw('IFNULL(AVG(notes.note), 0) AS avg_note'))
                        ->leftJoin('notes', 'scenes.id', '=', 'notes.id_scene')
                        ->groupBy('scenes.id')
                        ->get();
                    Cookie::expire('equipe');
                } else {
                    $scenes = Scene::select('scenes.*', DB::raw('IFNULL(AVG(notes.note), 0) AS avg_note'))
                        ->leftJoin('notes', 'scenes.id', '=', 'notes.id_scene')
                        ->where('equipe', $value)
                        ->groupBy('scenes.id')
                        ->get();
                    Cookie::queue('equipe', $cat, 10);
                }
            }
            if ($cat != 'All') {
                $scenes = Scene::select('scenes.*', DB::raw('IFNULL(AVG(notes.note), 0) AS avg_note'))
                    ->leftJoin('notes', 'scenes.id', '=', 'notes.id_scene')
                    ->where('equipe', $value)
                    ->groupBy('scenes.id')
                    ->get();
            } else {
                $scenes = Scene::select('scenes.*', DB::raw('IFNULL(AVG(notes.note), 0) AS avg_note'))
                    ->leftJoin('notes', 'scenes.id', '=', 'notes.id_scene')
                    ->groupBy('scenes.id')
                    ->get();
            }
        }

        $nb_disciplines = Scene::distinct('equipe')->pluck('equipe');

        Cookie::queue('equipe', $cat, 10);

        return view('scenes.index', [
            'title' => "Liste des scènes",
            'scenes' => $scenes,
            'equipe' => $cat,
            'nb' => $nb_disciplines,
            'filterType' => $filterType,
            'titre' => "Affichage des scènes"
        ]);
    }

    public function show($id) {
        $favoris = Favoris::all();
        $notes = Note::all();

        $scene = Scene::select('scenes.*', DB::raw('IFNULL(AVG(notes.note), 0) AS avg_note'))
            ->leftJoin('notes', 'scenes.id', '=', 'notes.id_scene')// Assurez-vous que 'scene_id' correspond à la clé étrangère
            ->where('scenes.id', $id)
            ->get()[0];
        $commentaires = Commentaire::select('commentaires.id AS com_id', 'commentaires.*', 'users.*')
            ->leftJoin('scenes', 'commentaires.id_scene', '=', 'scenes.id')
            ->leftJoin('users', 'commentaires.id_utilisateur', '=', 'users.id')
            ->where('scenes.id', $id)
            ->orderByDesc("commentaires.created_at")
            ->get();
        $nbNotes = count(Note::select('*')
            ->leftJoin('scenes', 'scenes.id', '=', 'notes.id_scene')
            ->where('scenes.id', $id)
            ->get());
        $not = Note::select(DB::raw("max(note) as maxi, min(note) as mini"))
            ->leftJoin('scenes', 'scenes.id', '=', 'notes.id_scene')
            ->where('scenes.id', $id)
            ->get();
        $fav = count(Favoris::select("*")
            ->leftJoin('scenes', 'scenes.id', '=', 'favoris.id_scene')
            ->where("scenes.id", $id)
            ->get());
        return view("scenes.show", ["not" => $not, "favoris"=>$favoris, "notes"=>$notes,"nn" => $nbNotes, 'scene' => $scene,
            'title' => "Affichage d'une scène", "commentaires" => $commentaires, 'fav' => $fav]);
    }

    public function createCom($id){
        $scene=Scene::find($id);
        $nbNotes = count(Note::select('*')
            ->leftJoin('scenes', 'scenes.id', '=', 'notes.id_scene')
            ->where('scenes.id', $id)
            ->get());
        return view("scenes.createCom",["n"=>$nbNotes,"title"=>"Création ","scene"=>$scene]);
    }
    public function storeCom(Request $request,$id) {
        $com=new Commentaire();
        $com->titre=$request->get("titre","a");
        $com->texte=$request->get("texte","a");
        $com->id_utilisateur=auth()->id();
        $com->id_scene=$id;
        $com->save();
        return redirect()->route("scenes.show", ['id'=> $id]);
    }
    public function deleteCom($id, $scene_id){
        $com=Commentaire::find($id);
        $idU=$com->id_utilisateur;
        $com->delete();
        return redirect()->route("scenes.show", ['id'=> $scene_id]);

    }

    public function  editCom($id,$scene_id){
        $nbNotes = count(Note::select('*')
            ->leftJoin('scenes', 'scenes.id', '=', 'notes.id_scene')
            ->where('scenes.id', $id)
            ->get());
        return view("scenes.editCom",["title"=>"Édition d'un commentaire","scene"=>Scene::find($scene_id),"com"=>Commentaire::find($id),"n"=>$nbNotes]);

    }
    public function updateCom(Request $request, $id)
    {
        $com = Commentaire::find($id);
        $com->titre=$request->titre;
        $com->texte=$request->texte;
        $com->save();



        return redirect()->route("scenes.show", ['id'=> $com->id_scene]);
    }

    public function addFavoris($id, $user_id) {

            $fav = new Favoris();
            $fav->id_utilisateur = $user_id;
            $fav->id_scene = $id;
            $fav->save();
        return redirect()->route('scenes.show',['id'=>"$id"]);
    }

    public function deleteFavoris($id, $user_id) {
        $deleted = Favoris::where('id_utilisateur', '=', intval($user_id))
            ->where('id_scene', '=', intval($id))
            ->delete();

        return redirect()->route('scenes.show', ['id' => $id]);
    }


}
