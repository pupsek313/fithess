<?php

namespace App\Http\Controllers;

use App\Models\Specialization;
use App\Models\Trainer;

class TrainerController extends Controller
{
    public function index()
{
    $trainers = Trainer::with('specialization')
        ->orderBy('id')
        ->get();

    $specializations = Specialization::withCount('trainers')
        ->orderBy('name')
        ->get();

    return view('trainers.index', compact('trainers', 'specializations'));
}

    public function show(Trainer $trainer)
    {
        $trainer->load('specialization');

        $others = $trainer->specialization->trainers()
            ->where('id', '!=', $trainer->id)
            ->take(3)
            ->get();

        return view('trainers.show', compact('trainer', 'others'));
    }
}