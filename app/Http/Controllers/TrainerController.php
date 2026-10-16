<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class TrainerController extends Controller
{
    public function index()
    {
        $trainers = DB::table('trainers')
            ->join('specializations', 'trainers.specialization_id', '=', 'specializations.id')
            ->select('trainers.*', 'specializations.name as specialization')
            ->orderBy('trainers.id')
            ->get();

        return view('trainers.index', compact('trainers'));
    }

    public function show(int $id)
    {
        $trainer = DB::table('trainers')
            ->join('specializations', 'trainers.specialization_id', '=', 'specializations.id')
            ->select('trainers.*', 'specializations.name as specialization')
            ->where('trainers.id', $id)
            ->first();

        abort_if(! $trainer, 404);

        return view('trainers.show', compact('trainer'));
    }
}