@extends('layouts.admin')

@section('title', 'Специализации')

@section('content')
    <div class="toolbar">
        <h1>Специализации</h1>
        <a href="{{ route('admin.specializations.create') }}" class="btn">Добавить</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Тренеров</th>
            <th>Создана</th>
            <th>Действия</th>
        </tr>
        @foreach ($specializations as $specialization)
            <tr>
                <td>{{ $specialization->id }}</td>
                <td>{{ $specialization->name }}</td>
                <td>{{ \Illuminate\Support\Str::limit($specialization->description, 50) }}</td>
                <td>{{ $specialization->trainers_count }}</td>
                <td>{{ $specialization->created_at->format('d.m.Y') }}</td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.specializations.edit', $specialization) }}" class="btn btn-small">Изменить</a>

                        <form method="POST" action="{{ route('admin.specializations.destroy', $specialization) }}"
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

    {{ $specializations->links('pagination.custom') }}
@endsection