@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <h1>Добро пожаловать!</h1>
    <div class="card">
        <p>Мы рады видеть вас в нашем фитнес-клубе. Тренируйтесь, растите и становитесь сильнее!</p>
        <p>В клубе работает тренеров: <strong>{{ $total }}</strong>. Сегодня: {{ $date }}</p>
    </div>

    <h2>Специализации</h2>
    <ul>
        @foreach ($specializations as $specialization)
            <li>
                <a href="{{ route('specializations.show', $specialization) }}">{{ $specialization->name }}</a>
                ({{ $specialization->trainers_count }})
            </li>
        @endforeach
    </ul>

    <h2>Новые тренеры</h2>
    @foreach ($latest as $trainer)
        <x-card class="card-wide"
                :title="$trainer->name"
                :url="route('trainers.show', $trainer->id)"
                :badge="$trainer->experience >= 8 ? 'Опытный' : null"
                :image="$trainer->photo_url"
                :alt="$trainer->name">
            {{ $trainer->specialization->name }}, стаж {{ $trainer->experience }} лет
        </x-card>
    @endforeach
@endsection