@extends('layouts.app')

@section('title', 'Наши тренеры')

@section('content')
    <h1>Наши тренеры</h1>

    <div class="catalog">
        <aside class="sidebar">
            <h2>Специализации</h2>
            <ul>
                @foreach ($specializations as $specialization)
                    <li>
                        <a href="{{ route('specializations.show', $specialization) }}">
                            {{ $specialization->name }} ({{ $specialization->trainers_count }})
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>

        <div class="catalog-list">
            @forelse ($trainers as $trainer)
                <x-card :title="$loop->iteration . '. ' . $trainer->name"
                        :url="route('trainers.show', $trainer->id)"
                        :badge="$trainer->experience >= 8 ? 'Опытный' : null">
                    {{ $trainer->specialization->name }}, стаж {{ $trainer->experience }} лет
                </x-card>
            @empty
                <x-alert type="info">Тренеры пока не добавлены.</x-alert>
            @endforelse
        </div>
    </div>
@endsection