<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    public const STATUSES = [
        'new'       => 'Новая',
        'processed' => 'Обработана',
        'rejected'  => 'Отклонена',
        'closed'    => 'Закрыта (устарела)'
    ];

    protected $fillable = [
        'user_id',
        'trainer_id',
        'phone',
        'comment',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function trainer(): BelongsTo
    {
        return $this->belongsTo(Trainer::class);
    }
}