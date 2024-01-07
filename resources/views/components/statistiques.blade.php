<div class="stats">
    <h3>Statistiques</h3>
    <p><strong>Note moyenne : </strong>{{$scene->avg_note}} <i>({{$n}} vote(s))</i></p>
    @if($n!=0)
        <p><strong>Note la plus haute : </strong>{{$notes[0]->maxi}}</p>
        <p><strong>Note la plus basse : </strong>{{$notes[0]->mini}}</p>
    @endif
    <p><strong>Nombre de favoris : </strong>{{$fav}}</p>
</div>
