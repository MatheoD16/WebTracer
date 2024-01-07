<!-- HTML structure with added classes -->
<nav class="navbar">
    <div class="main-buttons">
        @auth()
            <button class="nav-btn"><a href="{{route('home.home')}}">🏛 Accueil</a></button>
        @endauth
        <button class="nav-btn"><a href="{{route('home.apropos')}}">❔ A propos</a></button>
        <button class="nav-btn"><a href="{{route('home.contact')}}">☎️ Contact</a></button>
        <button class="nav-btn"><a href="{{route('scenes.index')}}">🖼️ Scènes</a></button>
    </div>
    <div class="auth-buttons">
        @guest()
            <button class="nav-btn"><a href="{{route('login')}}">Se connecter</a></button>
        @else
            <div class="user-menu">
                <button class="nav-btn" id="user-btn">
                    <img src="{{ url('storage/images/'.Auth::user()->avatar)}}" alt="Avatar">
                    <span>{{ Auth::user()->name }}</span>
                </button>
                <div class="user-dropdown" id="user-dropdown">
                    <button class="nav-btn" id="profil-btn"><a href="{{route('user.profil', ['id' => Auth::user()->id])}}}">Profil</a></button>
                    <button class="nav-btn" id="logout-btn"><a href="#">Se déconnecter</a></button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        @endguest
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Toggle user dropdown menu
            $("#user-btn").click(function () {
                $("#user-dropdown").toggle();
            });

            // Logout action
            $("#logout-btn").click(function () {
                $("#logout-form").submit();
            });

            // Hide dropdown on click outside
            $(document).click(function (e) {
                if (!$(e.target).closest('.user-menu').length) {
                    $("#user-dropdown").hide();
                }
            });
        });
    </script>
</nav>

