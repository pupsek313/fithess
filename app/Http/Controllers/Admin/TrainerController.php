<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTrainerRequest;
use App\Http\Requests\UpdateTrainerRequest;
use App\Models\Specialization;
use App\Models\Trainer;
use Illuminate\Support\Facades\Storage;

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
    $data = $request->validated();
    unset($data['remove_photo']);

    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('trainers', 'public');
    }

    Trainer::create($data);

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
    $data = $request->validated();
    unset($data['remove_photo']);

    if ($request->hasFile('photo')) {
        // загружена новая картинка: удаляем старый файл и сохраняем новый
        if ($trainer->photo) {
            Storage::disk('public')->delete($trainer->photo);
        }
        $data['photo'] = $request->file('photo')->store('trainers', 'public');
    } elseif ($request->boolean('remove_photo')) {
        // отмечено «Удалить фото»
        if ($trainer->photo) {
            Storage::disk('public')->delete($trainer->photo);
        }
        $data['photo'] = null;
    }
    // иначе ключа 'photo' в данных нет, и картинка остаётся прежней

    $trainer->update($data);

    return redirect()->route('admin.trainers.index')
        ->with('success', 'Изменения сохранены');
    }


    public function destroy(Trainer $trainer)
    {
    if ($trainer->photo) {
        Storage::disk('public')->delete($trainer->photo);
    }

    $trainer->delete();

    return back()->with('success', 'Тренер удалён');
    }
}