<?php

namespace App\Http\Controllers;

class TrainerController extends Controller
{
    public function index()
    {
        return view('trainers.index', ['items' => config('catalog.items')]);
    }

    public function show(int $id)
    {
        $trainer = config("catalog.items.$id");
        abort_if(! $trainer, 404);

        return view('trainers.show', compact('id', 'trainer'));
    }
}