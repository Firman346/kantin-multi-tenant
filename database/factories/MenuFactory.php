<?php

namespace Database\Factories;

use App\Models\MenuCategory;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<\App\Models\Menu> */
class MenuFactory extends Factory
{
    public function definition(): array
    {
        $tenant = Tenant::factory()->create();

        $category = MenuCategory::factory()->create([
            'tenant_id' => $tenant->id,
        ]);

        return [
            'tenant_id' => $tenant->id,
            'category_id' => $category->id,
            'name' => fake()->unique()->words(2, true),
            'base_price' => fake()->numberBetween(10000, 50000),
            'stock_qty' => fake()->numberBetween(0, 100),
            'is_available' => true,
        ];
    }
}