<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Тренеры — админка</title>
</head>
<body>
    <h1>Все тренеры</h1>
    <table border="1" cellpadding="6" cellspacing="0">
        <tr>
            <th>№</th>
            <th>Имя</th>
            <th>Специализация</th>
            <th>Стаж, лет</th>
            <th>Цена, тг/мес.</th>
        </tr>
        @foreach ($items as $id => $item)
            <tr>
                <td>{{ $id }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['specialty'] }}</td>
                <td>{{ $item['experience'] }}</td>
                <td>{{ $item['price'] }}</td>
            </tr>
        @endforeach
    </table>
    <a href="{{ route('admin.dashboard') }}">← В панель</a>
</body>
</html>