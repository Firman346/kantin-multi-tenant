<?php

namespace Database\Factories;

use App\Models\ModifierGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<\App\Models\ModifierOption> */
class ModifierOptionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'modifier_group_id' => ModifierGroup::factory(),
            'name' => fake()->unique()->word(),
            'price_delta' => fake()->numberBetween(0, 10000),
            'stock_qty' => fake()->numberBetween(0, 50),
            'is_available' => true,
        ];
    }
}