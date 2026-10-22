<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        $bookings = $user->bookings()
            ->with('trainer')
            ->latest()
            ->get();

        $notifications = $user->unreadNotifications()->latest()->get();

        return view('profile', compact('bookings', 'notifications'));
    }

    public function readNotifications(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();

        return redirect()->route('profile');
    }
}