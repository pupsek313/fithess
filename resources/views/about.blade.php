<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>О нас</title>
</head>
<body>
    <h1>О фитнес-клубе</h1>
    <p>{{ $description }}</p>
    <p>Студент: {{ $fio }}</p>
    <p>Группа: {{ $group }}</p>
    <a href="{{ route('home') }}">На главную</a>
</body>
</html>
