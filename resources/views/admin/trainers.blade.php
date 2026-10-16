@extends('layouts.admin')

@section('title', 'Тренеры')

@section('content')
    <h1>Все тренеры</h1>
    <table>
        <tr>
            <th>№</th>
            <th>Имя</th>
            <th>Специализация</th>
            <th>Стаж, лет</th>
            <th>Цена, тг/мес.</th>
        </tr>
        @foreach ($trainers as $trainer)
            <tr>
                <td>{{ $trainer->id }}</td>
                <td>
                    {{ $trainer->name }}
                    @if ($loop->first)
                        <x-badge>новая</x-badge>
                    @endif
                </td>
                <td>{{ $trainer->specialization }}</td>
                <td>{{ $trainer->experience }}</td>
                <td>{{ number_format($trainer->price, 0, '', ' ') }}</td>
            </tr>
        @endforeach
    </table>
@endsection