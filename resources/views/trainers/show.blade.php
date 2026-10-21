@extends('layouts.app')

@section('title', $trainer->name)

@section('content')
    <h1>{{ $trainer->name }}</h1>

    <div class="card">
        <img class="trainer-photo" src="{{ $trainer->photo_url }}" alt="{{ $trainer->name }}">

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

    @if ($trainer->attachment)
        @auth
            <p><a href="{{ route('trainers.attachment', $trainer) }}" class="btn">Скачать программу</a></p>
        @else
            <p class="muted">Войдите, чтобы скачать программу тренировок.</p>
        @endauth
    @endif

    <div class="qr-box">
    {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(140)->margin(1)->generate(route('trainers.show', $trainer)) !!}
    <div class="muted">QR-код со ссылкой на эту страницу</div>
    </div>

    @if ($others->isNotEmpty())
        <h2>Ещё из этой категории</h2>
        @foreach ($others as $other)
            <x-card :title="$other->name"
                    :url="route('trainers.show', $other->id)"
                    :image="$other->photo_url"
                    :alt="$other->name">
                Стаж: {{ $other->experience }} лет
            </x-card>
        @endforeach
    @endif

    <a href="{{ route('trainers.index') }}">← Назад к списку</a>
@endsection