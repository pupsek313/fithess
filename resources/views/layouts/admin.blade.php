<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Админка') — Админ-раздел</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin">
    <header>
        <div class="logo">Админ-раздел</div>
        @include('partials.admin-nav')
    </header>

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>