<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Models\User;
use App\Notifications\NewBooking;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class NotifyAdminsAboutBooking implements ShouldQueue
{
    public function handle(BookingCreated $event): void
    {
        $booking = $event->booking->loadMissing(['user', 'trainer']);

        Notification::send(
            User::whereIn('role', ['admin', 'editor'])->get(),
            new NewBooking($booking)
        );
    }
}