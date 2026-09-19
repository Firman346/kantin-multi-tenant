<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modifier_options', function (Blueprint $table) {
            $table->id();

            $table->foreignId('modifier_group_id')
                ->constrained('modifier_groups')
                ->cascadeOnDelete();

            $table->string('name');

            $table->decimal('price_delta', 15, 2)->default(0);

            $table->unsignedInteger('stock_qty')->default(0);

            $table->boolean('is_available')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modifier_options');
    }
};