<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Контакты</title>
</head>
<body>
    <h1>Контакты фитнес-клуба</h1>
    <p>Адрес: {{ $address }}</p>
    <p>Телефон: {{ $phone }}</p>
    <p>E-mail: {{ $email }}</p>
    <a href="{{ route('home') }}">На главную</a>
</body>
</html>
