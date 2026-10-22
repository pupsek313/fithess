<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Mail\BookingReceived;
use App\Models\Trainer;
use App\Models\User;
use App\Notifications\NewBooking;
use App\Services\BookingService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class BookingController extends Controller
{
    public function store(StoreBookingRequest $request, Trainer $trainer, BookingService $service)
    {
        $booking = $service->create($request->user(), $trainer, $request->validated());

        // связи нужны шаблонам письма и уведомления
        $booking->load(['user', 'trainer']);

        Mail::to($request->user())->send(new BookingReceived($booking));

        // уведомление всем, у кого есть доступ в админ-панель
        Notification::send(
            User::whereIn('role', ['admin', 'editor'])->get(),
            new NewBooking($booking)
        );

        return back()->with('success', "Заявка №{$booking->id} отправлена");
    }
}