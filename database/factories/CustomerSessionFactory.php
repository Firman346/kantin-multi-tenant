<?php

namespace Database\Factories;

use App\Models\DiningTable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/** @extends Factory<\App\Models\CustomerSession> */
class CustomerSessionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'dining_table_id' => DiningTable::factory(),
            'session_token_hash' => random_bytes(32),
            'status' => 'aktif',
            'expires_at' => now()->addHours(2),
        ];
    }
}