 <x-layout :title="$title">
    @auth()
     <!-- HTML structure with added classes -->
    <div class="home-container">
        <div class="user-welcome">
            <img src="{{ url('storage/images/'.Auth::user()->avatar) }}" alt="Avatar" class="avatar">
            <h2>Bienvenue, {{ Auth::user()->name }}!</h2>
        </div>
        <div class="additional-content">
            <p>Merci de vous connecter à notre fantastique application.</p>
            <p>Nous sommes ravis de vous avoir parmi nous!</p>
        </div>
    </div>
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
