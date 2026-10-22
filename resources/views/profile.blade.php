@extends('layouts.app')

@section('title', 'Мои заявки')

@section('content')
    <h1>Мои заявки</h1>

    @if ($notifications->isNotEmpty())
        <h2>Новые уведомления</h2>
        @foreach ($notifications as $n)
            <x-alert type="info">
                {{ $n->data['text'] }}
                <span class="muted">({{ $n->created_at->format('d.m.Y H:i') }})</span>
            </x-alert>
        @endforeach
        <form method="POST" action="{{ route('profile.notifications.read') }}">
            @csrf
            <button type="submit">Отметить прочитанными</button>
        </form>
    @endif

    <h2>Заявки</h2>
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