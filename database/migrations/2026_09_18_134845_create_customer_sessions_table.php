<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_sessions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('dining_table_id')
                ->constrained('dining_tables')
                ->cascadeOnDelete();

            $table->binary('session_token_hash', 32)->unique();

            $table->string('status')->default('aktif');

            $table->timestamp('expires_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_sessions');
    }
};