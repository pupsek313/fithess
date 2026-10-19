<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use App\Models\Trainer;
use Illuminate\Http\Request;

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

    // ---- задание 2 ----

    public function create()
    {
        $specializations = Specialization::orderBy('name')->get();

        return view('admin.trainers.create', compact('specializations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'specialization_id' => ['required', 'integer'],
            'name'              => ['required', 'string', 'max:120'],
            'phone'             => ['nullable', 'string', 'max:20'],
            'bio'               => ['nullable', 'string'],
            'experience'        => ['required', 'integer'],
            'price'             => ['required', 'numeric'],
        ]);
        $data['is_active'] = $request->boolean('is_active');

        Trainer::create($data);

        return redirect()->route('admin.trainers.index')
            ->with('success', 'Тренер добавлен');
    }

    // ---- задание 3 ----

    public function edit(Trainer $trainer)
    {
        $specializations = Specialization::orderBy('name')->get();

        return view('admin.trainers.edit', compact('trainer', 'specializations'));
    }

    public function update(Request $request, Trainer $trainer)
    {
        $data = $request->validate([
            'specialization_id' => ['required', 'integer'],
            'name'              => ['required', 'string', 'max:120'],
            'phone'             => ['nullable', 'string', 'max:20'],
            'bio'               => ['nullable', 'string'],
            'experience'        => ['required', 'integer'],
            'price'             => ['required', 'numeric'],
        ]);
        $data['is_active'] = $request->boolean('is_active');

        $trainer->update($data);

        return redirect()->route('admin.trainers.index')
            ->with('success', 'Изменения сохранены');
    }

    public function destroy(Trainer $trainer)
    {
        $trainer->delete();

        return back()->with('success', 'Тренер удалён');
    }
}