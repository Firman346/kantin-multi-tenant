<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<\App\Models\MenuStockMovement> */
class MenuStockMovementFactory extends Factory
{
    public function definition(): array
    {
        return [
            'menu_id' => Menu::factory(),
            'order_item_id' => null,
            'idempotency_key' => fake()->unique()->uuid(),
            'type' => 'sale',
            'quantity_delta' => fake()->numberBetween(-5, -1),
        ];
    }
}