<?php

namespace Database\Factories;

use App\Models\CustomerSession;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/** @extends Factory<\App\Models\Order> */
class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'public_order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'customer_session_id' => CustomerSession::factory(),
            'checkout_key' => Str::uuid()->toString(),
            'tracking_token_hash' => random_bytes(32),
            'status' => 'pending',
            'subtotal' => 0,
            'tax_total' => 0,
            'service_fee_total' => 0,
            'grand_total' => 0,
        ];
    }
}