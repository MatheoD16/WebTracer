<x-layout :title="$title">
    <div class="wrap">
        <form class="login-form" action="{{route('login')}}" method="post">
            @csrf
            <div class="form-header">
                <h3>Connexion</h3>
            </div>
            <!--Email Input-->
            <div class="form-group">
                <input type="text" name="email" class="form-input" placeholder="email@example.com">
            </div>
            <!--Password Input-->
            <div class="form-group">
                <input type="password" name="password" class="form-input" placeholder="password">
            </div>
            <div class="form-check">
                <input type="checkbox" name="name" class="form-check-input">
                <label class="form-check-label" for="exampleCheck1">Remember me</label>
            </div>
            <!--Login Button-->
            <div class="form-group">
                <button class="form-button" type="submit">Login</button>
            </div>
            <div class="form-footer">
                Vous n'avez pas de compte ? <a href="{{route('register')}}">Enregistrement</a>
            </div>
        </form>
    </div>
</x-layout>
