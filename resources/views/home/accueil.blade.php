<!-- HTML structure with added classes -->
<x-layout :title="$title" >
    <div class="home-container">
        <img src="{{ url('storage/images/dragon.png') }}" alt="le logo" class="logo">
        <p>Avez-vous un compte ? Si oui, <a href="login">cliquez ici</a>, sinon pour vous enregistrer c'est <a href="register">ici</a>.</p>
    </div>
</x-layout>
