<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SpecializationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                'Танцы', 'Плавание', 'Зумба', 'Аэробика', 'ТРХ', 'Табата', 'Кардио',
            ]),
            'description' => fake()->boolean(70) ? fake()->realText(100) : null,
        ];
    }
}