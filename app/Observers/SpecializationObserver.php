<?php

namespace App\Observers;

use App\Models\Specialization;
use Illuminate\Support\Facades\Cache;

class SpecializationObserver
{
    // меню, главная и панель админа зависят от списка специализаций
    private const CACHE_KEYS = ['home.stats', 'specializations.menu', 'admin.stats'];

    public function saved(Specialization $specialization): void
    {
        $this->forgetCache();
    }

    public function deleted(Specialization $specialization): void
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