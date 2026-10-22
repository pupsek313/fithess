<?php

namespace App\Observers;

use App\Models\Trainer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TrainerObserver
{
    public function created(Trainer $trainer): void
    {
        Log::info("Создан тренер #{$trainer->id}: {$trainer->name}");
    }

    public function updated(Trainer $trainer): void
    {
        Log::info("Изменён тренер #{$trainer->id}", $trainer->getChanges());
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
}