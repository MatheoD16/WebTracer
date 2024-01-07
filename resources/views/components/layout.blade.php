<!doctype html>
<html lang=fr>
<x-banner title={{$title}}>
</x-banner>
<body>
<menu>
    <x-header></x-header>
</menu>
<main>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
    @endif
    {{$slot}}
</main>
<footer>
    <x-footer></x-footer>
</footer>
</body>
</html>
