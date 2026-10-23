<?php

namespace App\Observers;

use App\Models\Trainer;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TrainerObserver
{
    // ключи кэша, которые зависят от данных о тренерах
    private const CACHE_KEYS = ['home.stats', 'specializations.menu', 'admin.stats'];

    public function created(Trainer $trainer): void
    {
        Log::info("Создан тренер #{$trainer->id}: {$trainer->name}");
    }

    public function updated(Trainer $trainer): void
    {
        Log::info("Изменён тренер #{$trainer->id}", $trainer->getChanges());
    }

    // saved срабатывает и при создании, и при изменении записи
    public function saved(Trainer $trainer): void
    {
        $this->forgetCache();
    }

    public function deleting(Trainer $trainer): void
    {
        if ($trainer->photo) {
            Storage::disk('public')->delete($trainer->photo);
        }
        if ($trainer->attachment) {
            Storage::delete($trainer->attachment);
        }
    }

    public function deleted(Trainer $trainer): void
    {
        $this->forgetCache();
    }

    private function forgetCache(): void
    {
        foreach (self::CACHE_KEYS as $key) {
            Cache::forget($key);
        }
    }
}