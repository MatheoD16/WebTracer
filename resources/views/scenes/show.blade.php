<x-layout :title="$title">

    <div class="scenes-container">
    @if(isset($scene))

    <h2>Affichage de la scène {{$scene->nom}}</h2>
    <img class="imgscene" src="{{$scene->lien_image}}" alt="Image de la scene">
    <div><strong>Description : </strong>{{$scene->description}}</div>





    <div><strong>Date d'ajout : </strong>{{$scene->creared_at}}</div>
    <div><strong>Équipe : </strong>{{$scene->equipe}}</div>

@auth()

        {{--Informations pour Favoris--}}
        <div style="display: none">
        {{$isFavoris = false}}

        @foreach($favoris as $f)
            @if($f->id_utilisateur == Auth::user()->id && $f->id_scene == $scene->id)
                {{$isFavoris = true}}

            @endif
                @endforeach
        </div>
        @if($isFavoris)
        <div><strong>Favoris : </strong>⭐</div>

        <form id="favoris" action="{{route("scenes.deleteFavoris", ['id'=>$scene->id, 'user_id'=>Auth::user()->id])}}" method="POST">
            @csrf
            <div><button class="nav-btn" id="favoris" type="submit">Supprimer</button></div>

        </form>

        @else
        <div><strong>Favoris : </strong>❌</div>

        <form id="favoris" action="{{route("scenes.addFavoris", ['id'=>$scene->id, 'user_id'=>Auth::user()->id])}}" method="POST">
            @csrf
            <div><button class="nav-btn" id="favoris" type="submit">Ajouter</button></div>

        </form>

        @endif

        {{--Informations pour la note--}}
        <div style="display: none">
        {{$hasNote = false}}
        {{$n = -1}}</div>
        @foreach($notes as $note)
            @if($note->id_utilisateur == Auth::user()->id && $note->id_scene == $scene->id)
                {{$hasNote = true}}
                {{$n = $note->note}}
            @endif
        @endforeach
        @if($hasNote)
            <div><strong>Votre note :</strong> {{$n}}
            <form id="note" action="{{route("scenes.updateNote", ['id'=>$scene->id, 'user_id'=>Auth::user()->id])}}" method="POST">
                @csrf
                <input type="number" name="note" id="note" value="{{$n}}" placeholder="Votre note" required min="0" max="5">
                <button class="nav-btn" id="note" type="submit">Modifier votre note</button>

            </form>

                <form id="delete" action="{{route("scenes.deleteNote", ['id'=>$scene->id, 'user_id'=>Auth::user()->id])}}" method="POST">
                @csrf
                    <button class="del-btn" id="delete" type="submit">Suprimmer la note</button>
                </form>

            </div>


        @else
            <div><strong>Vous n'avez pas encore noté la scène</strong>

                <form id="note" action="{{route("scenes.addNote", ['id'=>$scene->id, 'user_id'=>Auth::user()->id])}}" method="POST">
                    @csrf
                    <input type="number" name="note" id="note" placeholder="Votre note" required min="0" max="5">
                    <button class="add-btn" id="note" type="submit">Ajouter une note</button>
                </form>

            </div>

        @endif

        <div>
            <strong>Contenu de la scène :</strong>
            <pre style="font-family: monospace">
            <code>
            {{$scene->scene}}
            </code>
            </pre>
        </div>

    @endauth




            <x-statistiques :notes="$not" :scene="$scene" :n="$nn" :fav="$fav"></x-statistiques>

            <div>
        <div>
            <h3>Commentaire(s)</h3>
        </div>
        @auth()
        <div>
            <a  href="{{route("scenes.createCom",["id"=>$scene->id])}}"><button class="nav-btn">écrire un commentaire</button></a>
        </div>
        @endauth
        @foreach($commentaires as $com)

            <div class="commentaire">
                <img class="avatarcom" src="{{ url('storage/images/'.$com->avatar) }}" alt="Avatar">
                <span>{{ $com->name }}</span>
            </div>
            <div><strong>{{$com->titre}}</strong></div>
            <div><p>{{$com->texte}}</p></div>
            <div><p><i>
                        {{$com->created_at}}
                        @if($com->created_at!=$com->updated_at)
                             (modifié le {{$com->updated_at}})
                        @endif
            </i></p></div>
            @auth()
                @if(Auth::user()->admin == 1 || Auth::user()->id== $com->id_utilisateur)
                <div><a href="{{route("scenes.editCom",["id"=>$com->com_id, 'scene_id'=>$com->id_scene])}}"><button class="action-button edit-button">modifier</button></a> <a href="{{route("scenes.deleteCom",["id"=>$com->com_id, 'scene_id'=>$com->id_scene])}}"><button class="action-button delete-button-button">supprimer</button></a></div>
                @endif
            @endauth
            <HR>
        @endforeach
    </div>
    @else
    <h2>Aucune scène correspondante</h2>
    @endif
        </div><br>
</x-layout>
