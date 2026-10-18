@extends('layouts.app')

@section('title', $trainer->name)

@section('content')
    <h1>{{ $trainer->name }}</h1>
    <div class="card">
        <p>Тренер №{{ $trainer->id }}</p>
        <p>Специализация:
    <a href="{{ route('specializations.show', $trainer->specialization) }}">{{ $trainer->specialization->name }}</a>
</p>
        <p>Стаж: {{ $trainer->experience }} лет</p>
        <p>Стоимость: {{ number_format($trainer->price, 0, '', ' ') }} тг/мес.</p>
        @if ($trainer->bio)
            <p>{{ $trainer->bio }}</p>
        @endif
    </div>

    @if ($others->isNotEmpty())
        <h2>Ещё из этой категории</h2>
        @foreach ($others as $other)
            <x-card :title="$other->name"
                    :url="route('trainers.show', $other->id)">
                Стаж: {{ $other->experience }} лет
            </x-card>
        @endforeach
    @endif

    <a href="{{ route('trainers.index') }}">← Назад к списку</a>
@endsection