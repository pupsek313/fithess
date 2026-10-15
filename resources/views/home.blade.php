@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <h1>Добро пожаловать!</h1>
    <div class="card">
        <p>Мы рады видеть вас в нашем фитнес-клубе. Тренируйтесь, растите и становитесь сильнее!</p>
        <p>Сегодня: {{ $date }}</p>
    </div>
@endsection