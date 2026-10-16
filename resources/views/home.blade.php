@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <h1>Добро пожаловать!</h1>
    <div class="card">
        <p>Мы рады видеть вас в нашем фитнес-клубе. Тренируйтесь, растите и становитесь сильнее!</p>
        <p>Сегодня: {{ $date }}</p>
    </div>

    <h2>Наши тренеры</h2>
    @foreach ($items as $id => $item)
        <x-card class="card-wide"
                :title="$item['name']"
                :url="route('trainers.show', $id)"
                :badge="$item['experience'] >= 8 ? 'Опытный' : null">
            {{ $item['specialty'] }}, стаж {{ $item['experience'] }} лет
        </x-card>
    @endforeach
@endsection