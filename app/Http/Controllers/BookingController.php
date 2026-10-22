<?php

namespace App\Http\Controllers;

use App\Events\BookingCreated;
use App\Http\Requests\StoreBookingRequest;
use App\Models\Trainer;
use App\Services\BookingService;

class BookingController extends Controller
{
    public function store(StoreBookingRequest $request, Trainer $trainer, BookingService $service)
    {
        $booking = $service->create($request->user(), $trainer, $request->validated());

        BookingCreated::dispatch($booking);

        return back()->with('success', "Заявка №{$booking->id} отправлена");
    }
}