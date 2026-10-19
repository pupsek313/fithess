<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\Admin\SpecializationController as AdminSpecializationController;
use App\Http\Controllers\Admin\TrainerController as AdminTrainerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\TrainerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contacts', [PageController::class, 'contacts'])->name('contacts');
Route::get('/rules', [PageController::class, 'rules'])->name('rules');
Route::get('/hello/{name}', [PageController::class, 'hello']);
Route::redirect('/main', '/');

Route::get('/trainers', [TrainerController::class, 'index'])->name('trainers.index');
Route::get('/trainers/{trainer}', [TrainerController::class, 'show'])
    ->whereNumber('trainer')
    ->name('trainers.show');

Route::get('/specializations/{specialization}', [SpecializationController::class, 'show'])
    ->whereNumber('specialization')
    ->name('specializations.show');

Route::get('/booking', [PageController::class, 'booking'])
    ->middleware('hours:9,18')
    ->name('booking');

// регистрация и вход: только для гостей
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')->name('logout');

Route::prefix('admin')->name('admin.')->middleware('admin.key')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('trainers', AdminTrainerController::class)->except('show');
    Route::resource('specializations', AdminSpecializationController::class)->except('show');
});

Route::get('/admin/logout', LogoutController::class)->name('admin.logout');