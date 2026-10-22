<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Notifications\BookingStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'trainer'])
            ->latest()
            ->paginate(15);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['processed', 'rejected'])],
        ]);

        $booking->update($data);
        $booking->load('user');

        // пользователь узнаёт о смене статуса из уведомления в профиле
        $booking->user->notify(new BookingStatusChanged($booking));

        return back()->with('success', "Статус заявки №{$booking->id} изменён");
    }
}