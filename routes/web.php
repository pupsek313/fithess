<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\Admin\TrainerController as AdminTrainerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TrainerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contacts', [PageController::class, 'contacts'])->name('contacts');
Route::get('/rules', [PageController::class, 'rules'])->name('rules');
Route::get('/hello/{name}', [PageController::class, 'hello']);
Route::redirect('/main', '/');

Route::get('/trainers', [TrainerController::class, 'index'])->name('trainers.index');
Route::get('/trainers/{id}', [TrainerController::class, 'show'])
    ->whereNumber('id')
    ->name('trainers.show');

Route::get('/booking', [PageController::class, 'booking'])
    ->middleware('hours:9,18')
    ->name('booking');

Route::prefix('admin')->name('admin.')->middleware('admin.key')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('/trainers', [AdminTrainerController::class, 'index'])->name('trainers');
    Route::get('/trainers/create', [AdminTrainerController::class, 'create'])->name('trainers.create');
});

Route::get('/admin/logout', LogoutController::class)->name('admin.logout');