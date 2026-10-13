<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>Добро пожаловать в наш фитнес-клуб!</p>
    <p>Сегодня: {{ $date }}</p>

    <nav>
    <a href="{{ route('home') }}">Главная</a> |
    <a href="{{ route('about') }}">О нас</a> |
    <a href="{{ route('contacts') }}">Контакты</a> |
    <a href="{{ route('trainers.show', ['id' => 1]) }}">Тренеры</a>
</nav>
</body>
</html>
