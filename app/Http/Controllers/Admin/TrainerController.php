<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTrainerRequest;
use App\Http\Requests\UpdateTrainerRequest;
use App\Models\Specialization;
use App\Models\Trainer;

class TrainerController extends Controller
{
    public function index()
    {
        $trainers = Trainer::with('specialization')
            ->latest()
            ->orderByDesc('id')
            ->paginate(15);

        return view('admin.trainers.index', compact('trainers'));
    }

    public function create()
    {
        $specializations = Specialization::orderBy('name')->get();

        return view('admin.trainers.create', compact('specializations'));
    }

    public function store(StoreTrainerRequest $request)
    {
        Trainer::create($request->validated());

        return redirect()->route('admin.trainers.index')
            ->with('success', 'Тренер добавлен');
    }

    public function edit(Trainer $trainer)
    {
        $specializations = Specialization::orderBy('name')->get();

        return view('admin.trainers.edit', compact('trainer', 'specializations'));
    }

    public function update(UpdateTrainerRequest $request, Trainer $trainer)
    {
        $trainer->update($request->validated());

        return redirect()->route('admin.trainers.index')
            ->with('success', 'Изменения сохранены');
    }

    public function destroy(Trainer $trainer)
    {
        $trainer->delete();

        return back()->with('success', 'Тренер удалён');
    }
}