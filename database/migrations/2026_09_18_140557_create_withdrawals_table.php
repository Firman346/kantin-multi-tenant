<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tenant_id')
                ->constrained('tenants')
                ->cascadeOnDelete();

            $table->foreignId('tenant_bank_account_id')
                ->nullable()
                ->constrained('tenant_bank_accounts')
                ->nullOnDelete();

            $table->foreignId('verified_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('idempotency_key')->unique();

            $table->decimal('amount', 15, 2);

            $table->string('status')->default('pending');

            // Snapshot data transfer saat withdrawal dibuat
            $table->string('transfer_reference')->nullable();
            $table->text('bank_account_snapshot')->nullable();

            $table->timestamp('processed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};