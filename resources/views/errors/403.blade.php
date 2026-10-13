<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>403 — Доступ запрещён</title>
</head>
<body>
    <h1>Доступ запрещён</h1>
    <p>{{ $exception->getMessage() }}</p>
    <a href="{{ route('home') }}">На главную</a>
</body>
</html>