<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainerSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        DB::table('trainers')->insert([
            ['specialization_id' => 1, 'name' => 'Алексей Иванов',   'bio' => 'Мастер спорта по пауэрлифтингу',  'experience' => 8,  'price' => 50000, 'created_at' => $now, 'updated_at' => $now],
            ['specialization_id' => 2, 'name' => 'Айгерим Сатпаева', 'bio' => null,                               'experience' => 5,  'price' => 40000, 'created_at' => $now, 'updated_at' => $now],
            ['specialization_id' => 3, 'name' => 'Дмитрий Орлов',    'bio' => 'Сертифицированный тренер CrossFit', 'experience' => 6,  'price' => 45000, 'created_at' => $now, 'updated_at' => $now],
            ['specialization_id' => 4, 'name' => 'Мадина Касымова',  'bio' => null,                               'experience' => 4,  'price' => 38000, 'created_at' => $now, 'updated_at' => $now],
            ['specialization_id' => 5, 'name' => 'Ерлан Нурланов',   'bio' => 'Кандидат в мастера спорта',        'experience' => 10, 'price' => 55000, 'created_at' => $now, 'updated_at' => $now],
            ['specialization_id' => 2, 'name' => 'Мария Ким',        'bio' => null,                               'experience' => 7,  'price' => 42000, 'created_at' => $now, 'updated_at' => $now],
            ['specialization_id' => 3, 'name' => 'Руслан Ахметов',   'bio' => null,                               'experience' => 3,  'price' => 36000, 'created_at' => $now, 'updated_at' => $now],
            ['specialization_id' => 4, 'name' => 'Анна Петрова',     'bio' => 'Инструктор с медицинским образованием', 'experience' => 9, 'price' => 48000, 'created_at' => $now, 'updated_at' => $now],
            ['specialization_id' => 5, 'name' => 'Тимур Сарсенов',   'bio' => null,                               'experience' => 2,  'price' => 33000, 'created_at' => $now, 'updated_at' => $now],
            ['specialization_id' => 6, 'name' => 'Дана Омарова',     'bio' => null,                               'experience' => 5,  'price' => 39000, 'created_at' => $now, 'updated_at' => $now],
            ['specialization_id' => 1, 'name' => 'Игорь Волков',     'bio' => 'Тренер сборной области',           'experience' => 12, 'price' => 60000, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}