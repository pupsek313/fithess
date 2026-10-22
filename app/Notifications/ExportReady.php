<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ExportReady extends Notification
{
    use Queueable;

    public function __construct(public string $file)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'text' => "PDF-каталог готов: {$this->file}",
            // относительная ссылка: не зависит от адреса, под которым открыт сайт
            'url'  => route('admin.exports.download', $this->file, false),
        ];
    }
}