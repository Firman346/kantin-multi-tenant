<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<\App\Models\PaymentAttempt> */
class PaymentAttemptFactory extends Factory
{
    public function definition(): array
    {
        return [
            'payment_id' => Payment::factory(),
            'provider_reference' => 'PAY-' . fake()->unique()->numerify('########'),
            'attempt_no' => 1,
            'status' => 'pending',
        ];
    }
}