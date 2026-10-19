<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSpecializationRequest;
use App\Http\Requests\UpdateSpecializationRequest;
use App\Models\Specialization;

class SpecializationController extends Controller
{
    public function index()
    {
        $specializations = Specialization::withCount('trainers')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.specializations.index', compact('specializations'));
    }

    public function create()
    {
        return view('admin.specializations.create');
    }

    public function store(StoreSpecializationRequest $request)
    {
        Specialization::create($request->validated());

        return redirect()->route('admin.specializations.index')
            ->with('success', 'Специализация добавлена');
    }

    public function edit(Specialization $specialization)
    {
        return view('admin.specializations.edit', compact('specialization'));
    }

    public function update(UpdateSpecializationRequest $request, Specialization $specialization)
    {
        $specialization->update($request->validated());

        return redirect()->route('admin.specializations.index')
            ->with('success', 'Изменения сохранены');
    }

    public function destroy(Specialization $specialization)
    {
        if ($specialization->trainers()->exists()) {
            return back()->with('error', 'Нельзя удалить: есть связанные записи');
        }

        $specialization->delete();

        return back()->with('success', 'Специализация удалена');
    }
}