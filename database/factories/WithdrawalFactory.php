<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/** @extends Factory<\App\Models\Withdrawal> */
class WithdrawalFactory extends Factory
{
    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory(),
            'tenant_bank_account_id' => null,
            'verified_by' => null,
            'idempotency_key' => Str::uuid()->toString(),
            'amount' => fake()->numberBetween(10000, 100000),
            'status' => 'pending',
            'transfer_reference' => null,
            'bank_account_snapshot' => null,
            'processed_at' => null,
        ];
    }
}