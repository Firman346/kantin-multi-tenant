<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('public_order_number')->unique();

            $table->foreignId('customer_session_id')
                ->nullable()
                ->constrained('customer_sessions')
                ->nullOnDelete();

            $table->string('checkout_key')->unique();

            $table->binary('tracking_token_hash', 32);

            $table->string('status')->default('pending');

            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('tax_total', 15, 2)->default(0);
            $table->decimal('service_fee_total', 15, 2)->default(0);
            $table->decimal('grand_total', 15, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};