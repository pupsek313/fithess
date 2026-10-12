
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


Route::get('/trainers/{id}', function ($id) {
    return view('trainers.show', [
        'id' => $id,
    ]);
})->whereNumber('id')->name('trainers.show');
