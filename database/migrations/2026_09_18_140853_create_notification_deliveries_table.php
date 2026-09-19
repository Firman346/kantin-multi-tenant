<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notification_deliveries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('outbox_event_id')
                ->constrained('outbox_events')
                ->cascadeOnDelete();

            $table->string('key');

            $table->string('channel');

            $table->string('status')->default('pending');

            $table->unsignedInteger('attempts')->default(0);

            $table->timestamp('sent_at')->nullable();

            $table->text('last_error')->nullable();

            $table->timestamps();

            $table->unique(
                ['key', 'channel'],
                'notification_deliveries_key_channel_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_deliveries');
    }
};