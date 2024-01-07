<x-layout :title="$title">
    @auth
        <!-- HTML structure with added classes -->
        <h1 class="profile-title">Profil de {{ Auth::user()->name }}</h1>

        <div class="button-container">
            <button id="btn-info" class="btn btn-primary active">Infos</button>
            <button id="btn-favorites" class="btn btn-primary">Favoris</button>
            <button id="btn-commentaires" class="btn btn-primary">Commentaires</button>
        </div>

        <div class="profile-container" id="user-info">
            <div class="avatar-container">
                <img src="{{ url('storage/images/'.Auth::user()->avatar) }}" alt="Avatar de {{ Auth::user()->name }}" class="avatar"><br>
                <button id="changeAvatarBtn" class="action-button view-button" style="width:25%">Changer d'avatar</button>
            </div>
            <div class="profile-info">
                <p><strong>Nom :</strong> {{ Auth::user()->name }}</p>
                <p><strong>Email :</strong> {{ Auth::user()->email }}</p>
                <p><strong>Statut :</strong> {{ Auth::user()->admin ? 'Administrateur' : 'Utilisateur standard' }}</p>
            </div>
        </div>

        <div id="avatarModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeModal">&times;</span>
                <form id="avatarForm" action="{{route('user.avatarUpdate', ['id'=>Auth::user()->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="avatarInput">Choisir une image :</label>
                    <input type="file" name="document" id="avatarInput" accept="image/*">
                    <button type="submit" id="confirmBtn">Confirmer</button>
                </form>
            </div>
        </div>

        <!-- HTML avec des classes adaptées -->
        <section id="favorite-scenes" class="hidden">
            <div class="favorite-scenes-container">
                <h2>Mes scènes favorites</h2>
                <ul>
                    @foreach($scenes as $scene)
                        <li>
                            <button><a href="{{ route('scenes.show', [$scene->id]) }}">{{ $scene->nom }}</a></button>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        <section id="commentaires" class="hidden">
            <div class="commentaires-container">
                <h2>Mes commentaires</h2>
                <ul class="list-group">
                    @foreach($commentaires as $commentaire)
                        <li class="list-group-item">
                            <h3 class="comment-title">{{ $commentaire->titre }}</h3>
                            <p class="comment-text">{{ $commentaire->texte }}</p>
                            <p class="comment-dates">
                                <span class="comment-date-added">Ajouté le {{ $commentaire->created_at }}</span>
                                <span class="comment-date-updated">Dernière mise à jour le {{ $commentaire->updated_at }}</span>
                                <span class="comment-scene">Dans la scene <a href="{{ route('scenes.show', [$commentaire->id_scene]) }}">{{$commentaire->nom_scene}}</a></span>
                            </p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>


        <script>
            // Ajoutez votre code JavaScript ici
            document.getElementById('btn-info').addEventListener('click', function () {
                document.getElementById('user-info').classList.remove('hidden');
                document.getElementById('favorite-scenes').classList.add('hidden');
                document.getElementById('commentaires').classList.add('hidden')
                // Ajoutez/retirez la classe 'active' pour styliser le bouton actif
                document.getElementById('btn-info').classList.add('active');
                document.getElementById('btn-favorites').classList.remove('active');
                document.getElementById('commentaires').classList.remove('active')
            });

            document.getElementById('btn-favorites').addEventListener('click', function () {
                document.getElementById('user-info').classList.add('hidden');
                document.getElementById('favorite-scenes').classList.remove('hidden');
                document.getElementById('commentaires').classList.add('hidden')
                // Ajoutez/retirez la classe 'active' pour styliser le bouton actif
                document.getElementById('btn-info').classList.remove('active');
                document.getElementById('btn-favorites').classList.add('active');
                document.getElementById('commentaires').classList.remove('active')
            });

            document.getElementById('btn-commentaires').addEventListener('click', function () {
                document.getElementById('user-info').classList.add('hidden');
                document.getElementById('favorite-scenes').classList.add('hidden');
                document.getElementById('commentaires').classList.remove('hidden')
                // Ajoutez/retirez la classe 'active' pour styliser le bouton actif
                document.getElementById('btn-info').classList.remove('active');
                document.getElementById('btn-favorites').classList.remove('active');
                document.getElementById('commentaires').classList.add('active')
            });

            document.getElementById('changeAvatarBtn').addEventListener('click', function() {
                document.getElementById('avatarModal').style.display = 'block';
            });

            document.getElementById('closeModal').addEventListener('click', function() {
                document.getElementById('avatarModal').style.display = 'none';
            });

            document.getElementById('confirmBtn').addEventListener('click', function() {
                // Ajoutez le code pour traiter l'image ici
                // Vous pouvez utiliser document.getElementById('avatarInput').files[0] pour obtenir le fichier sélectionné
                // et envoyer les données au serveur, par exemple via une requête AJAX.

                // Après avoir traité l'image, vous pouvez fermer le modal
                document.getElementById('avatarModal').style.display = 'none';
            });
        </script>
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
