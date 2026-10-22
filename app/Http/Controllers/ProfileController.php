<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $bookings = $request->user()
            ->bookings()
            ->with('trainer')
            ->latest()
            ->get();

        return view('profile', compact('bookings'));
    }
}