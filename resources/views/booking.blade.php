<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Запись на тренировку</title>
</head>
<body>
    <h1>Записаться на тренировку</h1>
    <form>
        <p><label>Ваше имя: <input type="text" name="name"></label></p>
        <p><label>Телефон: <input type="tel" name="phone"></label></p>
        <button type="button">Записаться на тренировку</button>
    </form>
    <a href="{{ route('home') }}">На главную</a>
</body>
</html>