<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Canteen>
 */
class CanteenFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => strtoupper(fake()->unique()->lexify('CAN-????')),
            'slug' => fake()->unique()->slug(),
            'tax_rate' => 11.00,
            'service_fee_rate' => 5.00,
            'status' => 'aktif',
        ];
    }
}