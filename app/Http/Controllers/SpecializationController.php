<?php

namespace App\Http\Controllers;

use App\Models\Specialization;

class SpecializationController extends Controller
{
    public function show(Specialization $specialization)
    {
        $trainers = $specialization->trainers()
            ->orderBy('name')
            ->get();

        return view('specializations.show', compact('specialization', 'trainers'));
    }
}