<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\PaymentAttempt;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<\App\Models\PaymentEvent> */
class PaymentEventFactory extends Factory
{
    public function definition(): array
    {
        return [
            'payment_id' => Payment::factory(),
            'payment_attempt_id' => PaymentAttempt::factory(),
            'provider_event_id' => 'EVT-' . fake()->unique()->numerify('########'),
            'signature' => fake()->sha256(),
            'payload' => [
                'event' => 'payment.pending',
                'amount' => fake()->numberBetween(10000, 100000),
                'status' => 'pending',
            ],
        ];
    }
}