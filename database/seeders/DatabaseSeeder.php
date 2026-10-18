<?php

namespace Database\Seeders;

use App\Models\Specialization;
use App\Models\Trainer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // реальные записи из ЛР4
        $this->call([
            SpecializationSeeder::class,
            TrainerSeeder::class,
        ]);

        // 40 сгенерированных тренеров с уже существующими специализациями
        Trainer::factory(40)->recycle(Specialization::all())->create();
    }
}