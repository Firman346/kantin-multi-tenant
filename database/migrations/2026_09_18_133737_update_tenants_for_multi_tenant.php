<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->foreignId('canteen_id')
                ->after('id')
                ->constrained('canteens')
                ->cascadeOnDelete();

            $table->string('code')
                ->after('canteen_id');

            $table->string('status')
                ->default('aktif')
                ->after('slug');

            $table->softDeletes();
        });

        Schema::table('tenants', function (Blueprint $table) {
            $table->dropUnique('tenants_slug_unique');

            $table->unique(
                ['canteen_id', 'code'],
                'tenants_canteen_id_code_unique'
            );

            $table->unique(
                ['canteen_id', 'slug'],
                'tenants_canteen_id_slug_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropUnique('tenants_canteen_id_code_unique');
            $table->dropUnique('tenants_canteen_id_slug_unique');
            $table->dropForeign(['canteen_id']);
            $table->dropColumn(['canteen_id', 'code', 'status']);
            $table->dropSoftDeletes();
            $table->unique('slug', 'tenants_slug_unique');
        });
    }
};