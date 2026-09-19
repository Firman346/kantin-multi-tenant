<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commission_schemas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tenant_id')
                ->constrained('tenants')
                ->cascadeOnDelete();

            $table->decimal('commission_rate', 5, 2);

            $table->timestamp('valid_from');
            $table->timestamp('valid_to')->nullable();

            $table->timestamps();

            $table->index(
                ['tenant_id', 'valid_from'],
                'commission_schemas_tenant_valid_from_index'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commission_schemas');
    }
};