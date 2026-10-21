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
            <form method="GET" action="{{ route('trainers.index') }}" class="filters">
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Имя или описание">

                <select name="specialization">
                    <option value="">Все специализации</option>
                    @foreach ($specializations as $specialization)
                        <option value="{{ $specialization->id }}"
                                @selected(request('specialization') == $specialization->id)>
                            {{ $specialization->name }}
                        </option>
                    @endforeach
                </select>

                <select name="sort">
                    @foreach ($sorts as $key => $label)
                        <option value="{{ $key }}" @selected($sort === $key)>{{ $label }}</option>
                    @endforeach
                </select>

                <button type="submit">Найти</button>
                <a href="{{ route('trainers.index') }}">Сбросить</a>
            </form>

            <p class="found">Найдено: {{ $trainers->total() }}</p>

            <p> <a href="{{ route('trainers.pdf', request()->query()) }}" class="btn btn-small">Скачать PDF</a></p>

            @forelse ($trainers as $trainer)
                <x-card :title="($trainers->firstItem() + $loop->index) . '. ' . $trainer->name"
                        :url="route('trainers.show', $trainer->id)"
                        :badge="$trainer->experience >= 8 ? 'Опытный' : null"
                        :image="$trainer->photo_url"
                        :alt="$trainer->name">
                    {{ $trainer->specialization->name }}, стаж {{ $trainer->experience }} лет
                </x-card>
            @empty
                @if (request()->filled('q'))
                    <x-alert type="warning">По запросу «{{ request('q') }}» ничего не найдено</x-alert>
                @else
                    <x-alert type="info">Тренеры пока не добавлены.</x-alert>
                @endif
            @endforelse

            {{ $trainers->links('pagination.custom') }}
        </div>
    </div>
@endsection