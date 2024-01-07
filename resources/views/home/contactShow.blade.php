<x-layout :title="$title">

    <div class="contact-form">
        <div class="form-header text-center">
            <h3>Contact :</h3>
            <hr class="mt-2 mb-2">
        </div>

        <div class="form-group">
            <label for="email"><strong>Email :</strong></label>
            <input type="email" name="email" id="email" value="{{$email}}" disabled>
        </div>

        <div class="form-group">
            <label for="identity"><strong>Nom.Prénom :</strong></label>
            <input type="text" name="identity" id="identity" value="{{$identity}}" disabled>
        </div>

        <div class="form-group">
            <label for="description"><strong>Description :</strong></label>
            <textarea name="description" id="description" placeholder="Description" disabled>{{$description}}</textarea>
        </div>
        @auth
            <div class="form-group">
                <button class="btn btn-success"><a href="{{route('home.home')}}">Retour</a></button>
            </div>
        @endauth
        @guest
            <div class="form-group">
                <button class="btn btn-success"><a href="{{route('accueil')}}">Retour</a></button>
            </div>
        @endguest
    </div>

</x-layout>
