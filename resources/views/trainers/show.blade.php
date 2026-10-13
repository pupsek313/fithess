<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $trainer['name'] }}</title>
</head>
<body>
    <h1>{{ $trainer['name'] }}</h1>
    <p>Тренер №{{ $id }}</p>
    <p>Специализация: {{ $trainer['specialty'] }}</p>
    <p>Стаж: {{ $trainer['experience'] }} лет</p>
    <p>Стоимость: {{ number_format($trainer['price'], 0, '', ' ') }} тг/мес.</p>
    <a href="{{ route('trainers.index') }}">← Назад к списку</a>
    <br>
    <a href="{{ route('home') }}">На главную</a>
</body>
</html>