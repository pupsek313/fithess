@extends('layouts.app')

@section('title', $specialization->name)

@section('content')
    <h1>{{ $specialization->name }}</h1>

    @if ($specialization->description)
        <div class="card">
            <p>{{ $specialization->description }}</p>
        </div>
    @endif

    <h2>Тренеры ({{ $trainers->count() }})</h2>

    @forelse ($trainers as $trainer)
        <x-card :title="$trainer->name"
                :url="route('trainers.show', $trainer->id)"
                :badge="$trainer->experience >= 8 ? 'Опытный' : null">
            Стаж: {{ $trainer->experience }} лет
        </x-card>
    @empty
        <x-alert type="info">В этой специализации пока нет тренеров.</x-alert>
    @endforelse

    <a href="{{ route('trainers.index') }}">← Ко всем тренерам</a>
@endsection