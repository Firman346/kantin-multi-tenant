<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('actor_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('tenant_id')
                ->nullable()
                ->constrained('tenants')
                ->nullOnDelete();

            $table->string('entity_type');
            $table->unsignedBigInteger('entity_id');

            $table->string('action');

            $table->string('request_id')->nullable();

            $table->json('before')->nullable();
            $table->json('after')->nullable();

            $table->timestamps();

            $table->index(
                ['entity_type', 'entity_id'],
                'audit_logs_entity_index'
            );

            $table->index(
                ['tenant_id', 'created_at'],
                'audit_logs_tenant_created_index'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};