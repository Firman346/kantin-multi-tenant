<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tenant_id')
                ->constrained('tenants')
                ->cascadeOnDelete();

            $table->foreignId('category_id')
                ->constrained('menu_categories')
                ->cascadeOnDelete();

            $table->string('name');

            $table->decimal('base_price', 15, 2);

            $table->unsignedInteger('stock_qty')->default(0);

            $table->boolean('is_available')->default(true);

            $table->timestamps();

            $table->unique(
                ['tenant_id', 'name'],
                'menus_tenant_id_name_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};