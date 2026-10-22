<?php

namespace App\Http\Controllers;
use App\Models\Trainer;
use App\Models\Specialization;

use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    public function home()
{
    $data = [
        'total'           => Trainer::count(),
        'specializations' => Specialization::withCount('trainers')->orderBy('name')->get(),
        'latest'          => Trainer::with('specialization')->latest()->orderByDesc('id')->take(6)->get(),
    ];

    return view('home', $data + ['date' => date('d.m.Y')]);
}

    public function about()
    {
        return view('about', [
            'fio'         => 'Юхневич Руслан',
            'group'       => '3ПоВТ-24Б',
            'description' => 'Фитнес-клуб предлагает тренировки для людей с разным уровнем подготовки. Наши тренеры помогают клиентам достигать спортивных целей и поддерживать здоровый образ жизни.',
        ]);
    }

    public function contacts()
    {
        return view('contacts', [
            'address' => 'г. Костанай, ул. Толстого, 52',
            'phone'   => '+7 (700) 123-45-67',
            'email'   => 'infofitness@gmail.com',
        ]);
    }

    public function rules()
    {
        return view('rules');
    }

    public function booking()
    {
        return view('booking');
    }

    public function hello(string $name)
    {
        return "Здравствуйте, {$name}! Добро пожаловать в Фитнес-клуб.";
    }
}