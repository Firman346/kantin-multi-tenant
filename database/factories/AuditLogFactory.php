<?php

namespace Database\Factories;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<\App\Models\AuditLog> */
class AuditLogFactory extends Factory
{
    public function definition(): array
    {
        return [
            'actor_id' => null,
            'tenant_id' => Tenant::factory(),
            'entity_type' => 'order',
            'entity_id' => fake()->numberBetween(1, 100),
            'action' => 'created',
            'request_id' => fake()->uuid(),
            'before' => null,
            'after' => [
                'status' => 'pending',
            ],
        ];
    }
}