@extends('layouts.app')

@section('title', 'Наши тренеры')

@section('content')
    <h1>Наши тренеры</h1>

    @forelse ($items as $id => $item)
        <x-card :title="$loop->iteration . '. ' . $item['name']"
                :url="route('trainers.show', $id)"
                :badge="$item['experience'] >= 8 ? 'Опытный' : null">
            {{ $item['specialty'] }}, стаж {{ $item['experience'] }} лет
        </x-card>
    @empty
      <x-alert type="info">Тренеры пока не добавлены.</x-alert>
    @endforelse
@endsection