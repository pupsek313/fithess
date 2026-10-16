@extends('layouts.app')

@section('title', 'Наши тренеры')

@section('content')
    <h1>Наши тренеры</h1>

    @forelse ($trainers as $trainer)
        <x-card :title="$loop->iteration . '. ' . $trainer->name"
                :url="route('trainers.show', $trainer->id)"
                :badge="$trainer->experience >= 8 ? 'Опытный' : null">
            {{ $trainer->specialization }}, стаж {{ $trainer->experience }} лет
        </x-card>
    @empty
        <x-alert type="info">Тренеры пока не добавлены.</x-alert>
    @endforelse
@endsection