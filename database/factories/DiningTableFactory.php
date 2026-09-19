<?php

namespace Database\Factories;

use App\Models\Canteen;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<\App\Models\DiningTable> */
class DiningTableFactory extends Factory
{
    public function definition(): array
    {
        $canteen = Canteen::factory()->create();

        return [
            'canteen_id' => $canteen->id,
            'code' => 'TBL-' . fake()->unique()->numerify('###'),
            'label' => 'Meja ' . fake()->numberBetween(1, 50),
            'zone' => fake()->randomElement(['Indoor', 'Outdoor']),
            'status' => 'aktif',
        ];
    }
}