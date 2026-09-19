<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('table_qr_tokens', function (Blueprint $table) {
            $table->id();

            $table->foreignId('dining_table_id')
                ->constrained('dining_tables')
                ->cascadeOnDelete();

            $table->binary('token_hash', 32);

            $table->string('status')->default('aktif');

            $table->timestamp('expires_at')->nullable();
            $table->timestamp('revoked_at')->nullable();

            $table->timestamps();

            $table->index(
                ['token_hash'],
                'table_qr_tokens_token_hash_index'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('table_qr_tokens');
    }
};