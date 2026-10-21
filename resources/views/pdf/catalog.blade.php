<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: "DejaVu Sans", sans-serif; font-size: 11px; color: #222; }
        h1 { font-size: 18px; margin: 0 0 4px; }
        .sub { color: #666; margin-bottom: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 4px 6px; text-align: left; vertical-align: middle; }
        th { background: #e5e5e5; }
        .total { margin-top: 10px; font-weight: bold; }
    </style>
</head>
<body>
    <h1>{{ config('app.name') }}: каталог тренеров</h1>
    <div class="sub">по состоянию на {{ now()->format('d.m.Y') }}</div>

    <table>
        <tr>
            <th>№</th>
            <th>Фото</th>
            <th>Имя</th>
            <th>Специализация</th>
            <th>Стаж, лет</th>
            <th>Цена, тг/мес.</th>
        </tr>
        @foreach ($trainers as $trainer)
            @php
                $ext = strtolower(pathinfo((string) $trainer->photo, PATHINFO_EXTENSION));
                $path = $trainer->photo ? public_path('storage/' . $trainer->photo) : null;
                $hasImage = $path && in_array($ext, ['jpg', 'jpeg', 'png']) && file_exists($path);
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if ($hasImage)
                        <img src="{{ $path }}" width="36" alt="{{ $trainer->name }}">
                    @else
                        —
                    @endif
                </td>
                <td>{{ $trainer->name }}</td>
                <td>{{ $trainer->specialization->name }}</td>
                <td>{{ $trainer->experience }}</td>
                <td>{{ number_format($trainer->price, 0, '', ' ') }}</td>
            </tr>
        @endforeach
    </table>

    <div class="total">Всего записей: {{ $trainers->count() }}</div>
</body>
</html>