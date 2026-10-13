<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'title' => config('app.name'),
        'date' => date('d.m.Y'),
    ]);
})->name('home');


Route::get('/about', function () {
    return view('about', [
        'fio' => 'Юхневич Руслан',
        'group' => '3ПоВТ-24Б',
        'description' => 'Фитнес-клуб предлагает тренировки для людей с разным уровнем подготовки. Наши тренеры помогают клиентам достигать спортивных целей и поддерживать здоровый образ жизни.',
    ]);
})->name('about');


Route::get('/contacts', function () {
    return view('contacts', [
        'address' => 'г. Костанай, ул. Толстого, 52',
        'phone' => '+7 (700) 123-45-67',
        'email' => 'infofitness@gmail.com',
    ]);
})->name('contacts');


Route::get('/hello/{name}', function ($name) {
    return "Здравствуйте, {$name}! Добро пожаловать в Фитнес-клуб.";
});


Route::get('/trainers', function () {
    return view('trainers.index', ['items' => config('catalog.items')]);
})->name('trainers.index');

Route::get('/trainers/{id}', function (int $id) {
    $trainer = config("catalog.items.$id");
    if (! $trainer) {
        abort(404);
    }
    return view('trainers.show', ['id' => $id, 'trainer' => $trainer]);
})->whereNumber('id')->name('trainers.show');

Route::view('/rules', 'rules');
Route::redirect('/main', '/');

Route::prefix('admin')->name('admin.')->middleware('admin.key')->group(function () {
    Route::view('/', 'admin.dashboard')->name('dashboard');

    Route::get('/trainers', function () {
        return view('admin.trainers', ['items' => config('catalog.items')]);
    })->name('trainers');

    Route::view('/trainers/create', 'admin.trainers-create')->name('trainers.create');
});

Route::get('/admin/logout', function () {
    session()->forget('is_admin');
    return redirect('/');
})->name('admin.logout');

Route::view('/booking', 'booking')->middleware('hours:9,18')->name('booking');