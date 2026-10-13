<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новый тренер</title>
</head>
<body>
    <h1>Добавить тренера</h1>
    <form>
        <p><label>Имя: <input type="text" name="name"></label></p>
        <p><label>Специализация: <input type="text" name="specialty"></label></p>
        <p><label>Стаж: <input type="number" name="experience"></label></p>
        <p><label>Цена: <input type="number" name="price"></label></p>
        <button type="button">Сохранить</button>
    </form>
    <a href="{{ route('admin.dashboard') }}">← В панель</a>
</body>
</html>