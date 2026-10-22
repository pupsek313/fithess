<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Illuminate\Console\Command;

class CloseOldBookings extends Command
{
    protected $signature = 'bookings:close-old
        {--days=7 : Через сколько дней необработанная заявка считается устаревшей}
        {--dry-run : Только показать заявки, ничего не менять}';

    protected $description = 'Закрывает необработанные заявки старше N дней';

    public function handle(): int
    {
        $days = (int) $this->option('days');

        if ($days < 1) {
            $this->error('Параметр --days должен быть положительным числом.');

            return self::FAILURE;
        }

        $old = Booking::with(['user', 'trainer'])
            ->where('status', 'new')
            ->where('created_at', '<', now()->subDays($days))
            ->orderBy('id')
            ->get();

        if ($old->isEmpty()) {
            $this->info("Устаревших заявок (старше {$days} дн.) нет.");

            return self::SUCCESS;
        }

        $this->table(
            ['№', 'Пользователь', 'Тренер', 'Создана'],
            $old->map(fn (Booking $b) => [
                $b->id,
                $b->user->name,
                $b->trainer->name,
                $b->created_at->format('d.m.Y H:i'),
            ])->all()
        );

        if ($this->option('dry-run')) {
            $this->warn("Пробный запуск: найдено заявок {$old->count()}, ничего не изменено.");

            return self::SUCCESS;
        }

        if (! $this->confirm("Закрыть заявок: {$old->count()}?", true)) {
            $this->line('Отменено.');

            return self::SUCCESS;
        }

        $this->withProgressBar($old, fn (Booking $b) => $b->update(['status' => 'closed']));
        $this->newLine(2);
        $this->info("Закрыто заявок: {$old->count()}.");

        return self::SUCCESS;
    }
}