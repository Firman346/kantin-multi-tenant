<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dining_tables', function (Blueprint $table) {
            $table->id();

            $table->foreignId('canteen_id')
                ->constrained('canteens')
                ->cascadeOnDelete();

            $table->string('code');
            $table->string('label')->nullable();
            $table->string('zone')->nullable();
            $table->string('status')->default('aktif');

            $table->timestamps();

            $table->unique(
                ['canteen_id', 'code'],
                'dining_tables_canteen_id_code_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dining_tables');
    }
};