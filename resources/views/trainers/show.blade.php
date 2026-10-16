@extends('layouts.app')

@section('title', $trainer->name)

@section('content')
    <h1>{{ $trainer->name }}</h1>
    <div class="card">
        <p>Тренер №{{ $trainer->id }}</p>
        <p>Специализация: {{ $trainer->specialization }}</p>
        <p>Стаж: {{ $trainer->experience }} лет</p>
        <p>Стоимость: {{ number_format($trainer->price, 0, '', ' ') }} тг/мес.</p>
        @if ($trainer->bio)
            <p>{{ $trainer->bio }}</p>
        @endif
    </div>
    <a href="{{ route('trainers.index') }}">← Назад к списку</a>
@endsection