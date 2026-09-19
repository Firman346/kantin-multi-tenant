<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\TenantOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<\App\Models\OrderItem> */
class OrderItemFactory extends Factory
{
    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 5);
        $price = fake()->numberBetween(10000, 50000);
        $modifierTotal = 0;
        $lineTotal = ($price * $quantity) + $modifierTotal;

        return [
            'tenant_order_id' => TenantOrder::factory(),
            'menu_id' => Menu::factory(),
            'name' => fake()->words(2, true),
            'price' => $price,
            'quantity' => $quantity,
            'modifier_total' => $modifierTotal,
            'line_total' => $lineTotal,
        ];
    }
}