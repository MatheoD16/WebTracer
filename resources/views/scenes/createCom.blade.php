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
    <form id="filterForm" action="{{ route('scenes.storeCom', ['id'=> $scene->id])}}" method="POST">
        @csrf
        <div class="text-center" style="margin-top: 2rem">
            <h3>création d'un commentaire</h3>
            <hr class="mt-2 mb-2">
        </div>
        <div class="form-group">
            <input type="text" name="titre" class="form-input" placeholder="Titre">
        </div>
        <div class="form-group">
            <input type="text" name="texte" class="form-input" placeholder="Commentaire">
        </div>


        <input type="submit" value="valider">
    </form>
        @endif
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
