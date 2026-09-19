<?php

namespace Database\Factories;

use App\Models\ModifierGroup;
use App\Models\ModifierOption;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<\App\Models\OrderItemModifier> */
class OrderItemModifierFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_item_id' => OrderItem::factory(),
            'modifier_group_id' => ModifierGroup::factory(),
            'modifier_option_id' => ModifierOption::factory(),
            'price_delta' => fake()->numberBetween(0, 10000),
        ];
    }
}