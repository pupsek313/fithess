@extends('layouts.admin')

@section('title', 'Заявки')

@section('content')
    <h1>Заявки</h1>

    <table>
        <tr>
            <th>№</th>
            <th>Кто</th>
            <th>Тренер</th>
            <th>Телефон</th>
            <th>Дата</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        @forelse ($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->user->name }}<br><span class="muted">{{ $booking->user->email }}</span></td>
                <td>{{ $booking->trainer->name }}</td>
                <td>{{ $booking->phone }}</td>
                <td>{{ $booking->created_at->format('d.m.Y H:i') }}</td>
                <td>{{ \App\Models\Booking::STATUSES[$booking->status] ?? $booking->status }}</td>
                <td>
                    @if ($booking->status === 'new')
                        <div class="actions">
                            <form method="POST" action="{{ route('admin.bookings.update', $booking) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="processed">
                                <button class="small">Обработана</button>
                            </form>
                            <form method="POST" action="{{ route('admin.bookings.update', $booking) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button class="danger">Отклонить</button>
                            </form>
                        </div>
                    @else
                        —
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="7">Заявок пока нет.</td></tr>
        @endforelse
    </table>

    {{ $bookings->links('pagination.custom') }}
@endsection