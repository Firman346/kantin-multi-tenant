<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_stock_movements', function (Blueprint $table) {
            $table->id();

            $table->foreignId('menu_id')
                ->constrained('menus')
                ->cascadeOnDelete();

            $table->foreignId('order_item_id')
                ->nullable()
                ->constrained('order_items')
                ->nullOnDelete();

            $table->string('idempotency_key')->unique();

            $table->string('type');

            $table->integer('quantity_delta');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_stock_movements');
    }
};