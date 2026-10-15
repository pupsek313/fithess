@extends('layouts.app')

@section('title', $trainer['name'])

@section('content')
    <h1>{{ $trainer['name'] }}</h1>
    <div class="card">
        <p>Тренер №{{ $id }}</p>
        <p>Специализация: {{ $trainer['specialty'] }}</p>
        <p>Стаж: {{ $trainer['experience'] }} лет</p>
        <p>Стоимость: {{ number_format($trainer['price'], 0, '', ' ') }} тг/мес.</p>
    </div>
    <a href="{{ route('trainers.index') }}">← Назад к списку</a>
@endsection