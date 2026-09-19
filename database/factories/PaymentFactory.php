<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/** @extends Factory<\App\Models\Payment> */
class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'idempotency_key' => Str::uuid()->toString(),
            'provider_reference' => null,
            'amount' => fake()->numberBetween(10000, 100000),
            'status' => 'pending',
            'settled_at' => null,
        ];
    }
}