<?php

namespace Database\Factories;

use App\Models\Specialization;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'specialization_id' => Specialization::factory(),
            'name'              => fake('ru_RU')->name(),
            'phone'             => fake('ru_RU')->numerify('+7 (7##) ###-##-##'),
            'bio'               => fake('ru_RU')->boolean(60) ? fake('ru_RU')->realText(120) : null,
            'experience'        => fake('ru_RU')->numberBetween(1, 20),
            'price'             => fake('ru_RU')->numberBetween(30, 70) * 1000,
            'is_active'         => fake('ru_RU')->boolean(85),
        ];
    }
}