<?php

namespace Database\Factories;

use App\Models\OutboxEvent;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<\App\Models\NotificationDelivery> */
class NotificationDeliveryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'outbox_event_id' => OutboxEvent::factory(),
            'key' => 'notif-' . fake()->unique()->uuid(),
            'channel' => 'email',
            'status' => 'pending',
            'attempts' => 0,
            'sent_at' => null,
            'last_error' => null,
        ];
    }
}