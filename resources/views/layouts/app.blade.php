<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Фитнес-клуб') — Фитнес-клуб</title>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body>
    <header>
        <div class="logo">Фитнес-клуб</div>
        @include('partials.nav')
    </header>

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>