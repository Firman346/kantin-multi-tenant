<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/** @extends Factory<\App\Models\LedgerEntry> */
class LedgerEntryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory(),
            'payment_id' => null,
            'withdrawal_id' => null,
            'idempotency_key' => Str::uuid()->toString(),
            'type' => 'credit',
            'amount' => fake()->numberBetween(10000, 100000),
            'available_at' => now(),
            'held_until' => null,
        ];
    }
}