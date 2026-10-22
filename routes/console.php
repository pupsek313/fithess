<?php

use App\Jobs\GenerateCatalogPdf;
use App\Models\Booking;
use App\Models\Specialization;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('catalog:stats', function () {
    $this->info('Тренеров в каталоге: ' . Trainer::count());

    $this->newLine();
    $this->line('Тренеры по специализациям:');
    $this->table(
        ['Специализация', 'Тренеров'],
        Specialization::withCount('trainers')
            ->orderBy('name')
            ->get()
            ->map(fn ($s) => [$s->name, $s->trainers_count])
            ->all()
    );

    $this->line('Пользователи по ролям:');
    $this->table(
        ['Роль', 'Пользователей'],
        User::selectRaw('role, count(*) as total')
            ->groupBy('role')
            ->orderBy('role')
            ->get()
            ->map(fn ($r) => [$r->role, $r->total])
            ->all()
    );

    $this->line('Заявки по статусам:');
    $this->table(
        ['Статус', 'Заявок'],
        Booking::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->orderBy('status')
            ->get()
            ->map(fn ($r) => [Booking::STATUSES[$r->status] ?? $r->status, $r->total])
            ->all()
    );
})->purpose('Короткая статистика каталога');

// ---- расписание ----

// каждую ночь закрываем устаревшие заявки
Schedule::command('bookings:close-old --days=7')
    ->dailyAt('03:00')
    ->withoutOverlapping();

// статистика каждую минуту дописывается в файл
Schedule::command('catalog:stats')
    ->everyMinute()
    ->appendOutputTo(storage_path('logs/stats.log'));

// по понедельникам в 8:00 формируем PDF-каталог в фоне
Schedule::call(function () {
    $admin = User::where('role', 'admin')->first();

    if ($admin) {
        GenerateCatalogPdf::dispatch($admin);
    }
})->name('weekly-catalog-pdf')->weeklyOn(1, '08:00');