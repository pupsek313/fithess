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
        unset($data['remove_photo'], $data['remove_attachment']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('trainers', 'public');
        }
        if ($request->hasFile('attachment')) {
            // закрытый диск (local): без второго параметра
            $data['attachment'] = $request->file('attachment')->store('attachments');
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
        unset($data['remove_photo'], $data['remove_attachment']);

        // фото (открытый диск)
        if ($request->hasFile('photo')) {
            if ($trainer->photo) {
                Storage::disk('public')->delete($trainer->photo);
            }
            $data['photo'] = $request->file('photo')->store('trainers', 'public');
        } elseif ($request->boolean('remove_photo')) {
            if ($trainer->photo) {
                Storage::disk('public')->delete($trainer->photo);
            }
            $data['photo'] = null;
        }

        // документ (закрытый диск)
        if ($request->hasFile('attachment')) {
            if ($trainer->attachment) {
                Storage::delete($trainer->attachment);
            }
            $data['attachment'] = $request->file('attachment')->store('attachments');
        } elseif ($request->boolean('remove_attachment')) {
            if ($trainer->attachment) {
                Storage::delete($trainer->attachment);
            }
            $data['attachment'] = null;
        }

        $trainer->update($data);

        return redirect()->route('admin.trainers.index')
            ->with('success', 'Изменения сохранены');
    }

    public function destroy(Trainer $trainer)
    {
        if ($trainer->photo) {
            Storage::disk('public')->delete($trainer->photo);
        }
        if ($trainer->attachment) {
            Storage::delete($trainer->attachment);
        }

        $trainer->delete();

        return back()->with('success', 'Тренер удалён');
    }
}