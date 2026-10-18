@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <h1>Добро пожаловать!</h1>
    <div class="card">
        <p>Мы рады видеть вас в нашем фитнес-клубе. Тренируйтесь, растите и становитесь сильнее!</p>
        <p>Сегодня: {{ $date }}</p>
    </div>

    <h2>Наши тренеры</h2>
    @foreach ($trainers as $trainer)
        <x-card class="card-wide"
                :title="$trainer->name"
                :url="route('trainers.show', $trainer->id)"
                :badge="$trainer->experience >= 8 ? 'Опытный' : null">
           {{ $trainer->specialization->name }}, стаж {{ $trainer->experience }} лет
        </x-card>
    @endforeach
@endsection