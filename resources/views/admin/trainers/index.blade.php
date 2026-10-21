@extends('layouts.admin')

@section('title', 'Тренеры')

@section('content')
    <div class="toolbar">
        <h1>Тренеры</h1>
        <a href="{{ route('admin.trainers.create') }}" class="btn">Добавить</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Фото</th>
            <th>Имя</th>
            <th>Специализация</th>
            <th>Стаж, лет</th>
            <th>Цена, тг/мес.</th>
            <th>Активен</th>
            <th>Создан</th>
            <th>Действия</th>
        </tr>
        @foreach ($trainers as $trainer)
            <tr>
                <td>{{ $trainer->id }}</td>
                <td>
                    <img class="thumb" src="{{ $trainer->photo_url }}" alt="{{ $trainer->name }}" width="60" height="60">
                </td>
                <td>
                    {{ $trainer->name }}
                    @if ($trainers->onFirstPage() && $loop->first)
                        <x-badge>новая</x-badge>
                    @endif
                </td>
                <td>{{ $trainer->specialization->name }}</td>
                <td>{{ $trainer->experience }}</td>
                <td>{{ number_format($trainer->price, 0, '', ' ') }}</td>
                <td>{{ $trainer->is_active ? 'да' : 'нет' }}</td>
                <td>{{ $trainer->created_at->format('d.m.Y') }}</td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.trainers.edit', $trainer) }}" class="btn btn-small">Изменить</a>

                        <form method="POST" action="{{ route('admin.trainers.destroy', $trainer) }}"
                              onsubmit="return confirm('Удалить запись?')">
                            @csrf
                            @method('DELETE')
                            <button class="danger">Удалить</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>

    {{ $trainers->links('pagination.custom') }}
@endsection