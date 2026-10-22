@extends('layouts.app')

@section('title', 'Мои заявки')

@section('content')
    <h1>Мои заявки</h1>

    @forelse ($bookings as $booking)
        <div class="card">
            <a href="{{ route('trainers.show', $booking->trainer_id) }}">{{ $booking->trainer->name }}</a>
            <span class="badge">{{ \App\Models\Booking::STATUSES[$booking->status] ?? $booking->status }}</span>
            <p class="muted">
                Заявка №{{ $booking->id }} от {{ $booking->created_at->format('d.m.Y H:i') }},
                телефон {{ $booking->phone }}
            </p>
            @if ($booking->comment)
                <p>{{ $booking->comment }}</p>
            @endif
        </div>
    @empty
        <x-alert type="info">У вас пока нет заявок. Выберите тренера в <a href="{{ route('trainers.index') }}">каталоге</a>.</x-alert>
    @endforelse
@endsection