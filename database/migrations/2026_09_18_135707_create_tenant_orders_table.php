<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenant_orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();

            $table->foreignId('tenant_id')
                ->constrained('tenants')
                ->cascadeOnDelete();

            $table->foreignId('commission_id')
                ->nullable()
                ->constrained('commission_schemas')
                ->nullOnDelete();

            $table->string('status')->default('pending');

            $table->timestamp('scheduled_at')->nullable();

            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('tax_total', 15, 2)->default(0);
            $table->decimal('service_fee_total', 15, 2)->default(0);
            $table->decimal('commission_total', 15, 2)->default(0);

            $table->timestamps();

            $table->unique(
                ['order_id', 'tenant_id'],
                'tenant_orders_order_id_tenant_id_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenant_orders');
    }
};