<?php

namespace Database\Seeders;

use App\Models\Specialization;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // тестовые пользователи, пароль у всех: password
        User::factory()->create([
            'name'     => 'Администратор',
            'email'    => 'admin@test.kz',
            'password' => 'password',
            'role'     => 'admin',
        ]);
        User::factory()->create([
            'name'     => 'Редактор',
            'email'    => 'editor@test.kz',
            'password' => 'password',
            'role'     => 'editor',
        ]);
        User::factory()->create([
            'name'     => 'Пользователь',
            'email'    => 'user@test.kz',
            'password' => 'password',
            'role'     => 'user',
        ]);

        // реальные записи из ЛР4
        $this->call([
            SpecializationSeeder::class,
            TrainerSeeder::class,
        ]);

        // 40 сгенерированных тренеров
        Trainer::factory(40)->recycle(Specialization::all())->create();
    }
}