<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        DB::table('specializations')->insert([
            ['name' => 'Силовые тренировки', 'description' => 'Работа с весами и тренажёрами, набор мышечной массы', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Йога',               'description' => 'Гибкость, дыхание и расслабление',                    'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Кроссфит',           'description' => 'Функциональные высокоинтенсивные тренировки',         'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Пилатес',            'description' => 'Укрепление мышц кора и осанки',                       'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Бокс',               'description' => 'Техника ударов, выносливость и скорость',             'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Стретчинг',          'description' => null,                                                  'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}