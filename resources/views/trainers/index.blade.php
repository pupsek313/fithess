<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Наши тренеры</title>
</head>
<body>
    <h1>Наши тренеры</h1>
    <ul>
        @foreach ($items as $id => $item)
            <li><a href="{{ route('trainers.show', $id) }}">{{ $item['name'] }}</a></li>
        @endforeach
    </ul>
    <a href="{{ route('home') }}">На главную</a>
</body>
</html>