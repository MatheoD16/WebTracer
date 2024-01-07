<x-layout :title="$title">
    @auth()
    <div class="scenes-container">
        @if(isset($scene))
            <h2>Affichage de la scène {{$scene->nom}}</h2>
            <img class="imgscene" src="{{$scene->lien_image}}" alt="Image de la scene">
            <div><strong>Description : </strong>{{$scene->description}}</div>
            <div><strong>Date d'ajout : </strong>{{$scene->creared_at}}</div>
            <div><strong>Équipe : </strong>{{$scene->equipe}}</div>
            <div><strong>Note : </strong>{{$scene->avg_note}} <i>({{$n}} vote(s))</i></div>
        @endif
            <form action="{{route('scenes.updateCom',["id"=>$com->id,"scene_id"=>$scene->id])}}" method="POST">
                @csrf

                <div class="text-center" style="margin-top: 2rem">
                    <h3>Modification d'un commentaire</h3>
                    <hr class="mt-2 mb-2">
                </div>
                <div>
                    <label for="titre"><strong>titre</strong></label>
                    <input type="text" class="form-control" id="titre" name="titre"
                           value="{{ $com->titre}}">
                    <label for="texte"><strong>texte</strong></label>
                    <input type="text" class="form-control" id="texte" name="texte"
                           value="{{ $com->texte}}">
                </div>

                <div>
                    <button class="btn btn-success" type="submit">Valide</button>
                </div>
            </form>
    </div>
    <br><br>
    @endauth
        @guest()
            <div class="home-container">
                <div class="additional-content">
                    <p>Vous n'êtes pas connecté, vous n'avez pas accès à cette page !</p>

                    <div class="form-group">
                        <button class="btn btn-success"><a href="{{route('accueil')}}">Retour</a></button>
                    </div>
                </div>
            </div>
        @endguest
</x-layout>
