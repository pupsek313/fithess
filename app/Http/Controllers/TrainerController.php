<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Models\Trainer;

class TrainerController extends Controller
{
    public function index(Request $request)
{
    $sorts = [
        'name'       => 'По имени',
        'experience' => 'По стажу (сначала опытные)',
        'price'      => 'По цене (сначала дешёвые)',
        'new'        => 'Сначала новые',
    ];

    // белый список: чужое значение из адреса заменяется на 'name'
    $sort = in_array($request->query('sort'), array_keys($sorts), true)
        ? $request->query('sort')
        : 'name';

    $query = Trainer::with('specialization')
        ->search($request->string('q')->trim()->toString())
        ->when($request->integer('specialization'), fn ($q, $id) => $q->where('specialization_id', $id));

    $query = match ($sort) {
        'experience' => $query->orderByDesc('experience'),
        'price'      => $query->orderBy('price'),
        'new'        => $query->latest()->orderByDesc('id'),
        default      => $query->orderBy('name'),
    };

   $trainers = $query->paginate(9)->withQueryString();

    $specializations = Specialization::withCount('trainers')
        ->orderBy('name')
        ->get();

    return view('trainers.index', compact('trainers', 'specializations', 'sorts', 'sort'));
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