<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        return view('admin.trainers', compact('trainers'));
    }

    public function create()
    {
        return view('admin.trainers-create');
    }
}