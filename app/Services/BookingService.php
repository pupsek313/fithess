<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class BookingService
{
    // не больше стольких активных (новых) заявок на одного пользователя
    private const MAX_ACTIVE = 3;

    public function create(User $user, Trainer $trainer, array $data): Booking
    {
        if (! $trainer->is_active) {
            throw ValidationException::withMessages([
                'booking' => 'Этот тренер сейчас не принимает записи.',
            ]);
        }

        $active = $user->bookings()->where('status', 'new');

        if ((clone $active)->where('trainer_id', $trainer->id)->exists()) {
            throw ValidationException::withMessages([
                'booking' => 'Вы уже записаны к этому тренеру: дождитесь обработки заявки.',
            ]);
        }

        if ($active->count() >= self::MAX_ACTIVE) {
            throw ValidationException::withMessages([
                'booking' => 'У вас уже ' . self::MAX_ACTIVE . ' необработанные заявки. Дождитесь их обработки.',
            ]);
        }

        return Booking::create([
            'user_id'    => $user->id,
            'trainer_id' => $trainer->id,
            'phone'      => $data['phone'],
            'comment'    => $data['comment'] ?? null,
        ]);
    }
}