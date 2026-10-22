@extends('layouts.admin')

@section('title', 'Уведомления')

@section('content')
    <div class="toolbar">
        <h1>Уведомления</h1>
        <form method="POST" action="{{ route('admin.notifications.read') }}">
            @csrf
            <button type="submit">Отметить всё прочитанным</button>
        </form>
    </div>

    @forelse ($notifications as $n)
        <div @class(['card', 'read' => $n->read_at])>
            <strong>{{ $n->data['text'] }}</strong>
            @if (! empty($n->data['url']))
                <p><a href="{{ $n->data['url'] }}" class="btn btn-small">Скачать</a></p>
            @endif
            <p class="muted">{{ $n->created_at->format('d.m.Y H:i') }}</p>
        </div>
    @empty
        <x-alert type="info">Уведомлений пока нет.</x-alert>
    @endforelse

    {{ $notifications->links('pagination.custom') }}
@endsection