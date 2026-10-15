@extends('layouts.app')

@section('title', 'Наши тренеры')

@section('content')
    <h1>Наши тренеры</h1>

    @forelse ($items as $id => $item)
        <div class="card">
            {{ $loop->iteration }}.
            <a href="{{ route('trainers.show', $id) }}">{{ $item['name'] }}</a>
            @if ($item['experience'] >= 8)
                <span class="badge">Опытный</span>
            @endif
        </div>
    @empty
        <p>Тренеры пока не добавлены.</p>
    @endforelse
@endsection