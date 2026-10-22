<?php

namespace App\Jobs;

use App\Models\Trainer;
use App\Models\User;
use App\Notifications\ExportReady;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

class GenerateCatalogPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // сколько раз повторить при сбое (пригодится в задании 5)
    public int $tries = 3;

    public function __construct(public User $user)
    {
    }

    public function handle(): void
    {
        $trainers = Trainer::with('specialization')->orderBy('name')->get();

        $file = 'trainers-' . now()->format('Y-m-d_His') . '.pdf';

        Storage::put(
            "exports/{$file}",
            Pdf::loadView('pdf.catalog', compact('trainers'))->setPaper('a4')->output()
        );

        $this->user->notify(new ExportReady($file));
    }

    // вызывается, когда все попытки закончились неудачей (пригодится в задании 5)
    public function failed(Throwable $e): void
    {
        Log::error('Не удалось сформировать PDF-каталог: ' . $e->getMessage());
    }
}