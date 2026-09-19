<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/** @extends Factory<\App\Models\OutboxEvent> */
class OutboxEventFactory extends Factory
{
    public function definition(): array
    {
        return [
            'event_key' => Str::uuid()->toString(),
            'aggregate_type' => 'order',
            'aggregate_id' => fake()->numberBetween(1, 100),
            'event_type' => 'order.created',
            'payload' => [
                'status' => 'pending',
            ],
            'published_at' => null,
        ];
    }
}