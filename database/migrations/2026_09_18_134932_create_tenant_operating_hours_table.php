<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenant_operating_hours', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tenant_id')
                ->constrained('tenants')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('day');

            $table->time('opens_at');
            $table->time('closes_at');

            $table->timestamps();

            $table->unique(
                ['tenant_id', 'day'],
                'tenant_operating_hours_tenant_id_day_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenant_operating_hours');
    }
};