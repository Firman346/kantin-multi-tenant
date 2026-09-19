<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_categories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tenant_id')
                ->constrained('tenants')
                ->cascadeOnDelete();

            $table->string('name');

            $table->unsignedInteger('sort_order')->default(0);

            $table->boolean('active')->default(true);

            $table->timestamps();

            $table->unique(
                ['tenant_id', 'name'],
                'menu_categories_tenant_id_name_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_categories');
    }
};