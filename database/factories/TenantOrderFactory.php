<?php

namespace Database\Factories;

use App\Models\CommissionSchema;
use App\Models\Order;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<\App\Models\TenantOrder> */
class TenantOrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'tenant_id' => Tenant::factory(),
            'commission_id' => null,
            'status' => 'pending',
            'scheduled_at' => null,
            'subtotal' => 0,
            'tax_total' => 0,
            'service_fee_total' => 0,
            'commission_total' => 0,
        ];
    }
}