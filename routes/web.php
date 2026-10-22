<?php

use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\Admin\SpecializationController as AdminSpecializationController;
use App\Http\Controllers\Admin\TrainerController as AdminTrainerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\TrainerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contacts', [PageController::class, 'contacts'])->name('contacts');
Route::get('/rules', [PageController::class, 'rules'])->name('rules');
Route::get('/hello/{name}', [PageController::class, 'hello']);
Route::redirect('/main', '/');

// конкретные адреса объявляем раньше адресов с параметром {trainer}
Route::get('/trainers', [TrainerController::class, 'index'])->name('trainers.index');
Route::get('/trainers/pdf', [TrainerController::class, 'pdf'])->name('trainers.pdf');
Route::get('/trainers/{trainer}', [TrainerController::class, 'show'])
    ->whereNumber('trainer')
    ->name('trainers.show');
Route::get('/trainers/{trainer}/attachment', [TrainerController::class, 'attachment'])
    ->whereNumber('trainer')
    ->middleware('auth')
    ->name('trainers.attachment');
Route::post('/trainers/{trainer}/bookings', [BookingController::class, 'store'])
    ->whereNumber('trainer')
    ->middleware('auth')
    ->name('bookings.store');

Route::get('/specializations/{specialization}', [SpecializationController::class, 'show'])
    ->whereNumber('specialization')
    ->name('specializations.show');

Route::get('/booking', [PageController::class, 'booking'])
    ->middleware('hours:9,18')
    ->name('booking');

Route::get('/profile', [ProfileController::class, 'show'])
    ->middleware('auth')
    ->name('profile');
Route::post('/profile/notifications/read', [ProfileController::class, 'readNotifications'])
    ->middleware('auth')
    ->name('profile.notifications.read');

// регистрация и вход: только для гостей
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->middleware('throttle:5,1');
});

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')->name('logout');

// админка: вошедшие пользователи с правом admin-panel
Route::prefix('admin')->name('admin.')->middleware(['auth', 'can:admin-panel'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('trainers', AdminTrainerController::class)->except('show');
    Route::resource('specializations', AdminSpecializationController::class)->except('show');

    Route::get('bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::patch('bookings/{booking}', [AdminBookingController::class, 'update'])
        ->whereNumber('booking')
        ->name('bookings.update');

    Route::get('notifications', [AdminNotificationController::class, 'index'])->name('notifications');
    Route::post('notifications/read', [AdminNotificationController::class, 'markAllRead'])->name('notifications.read');
});