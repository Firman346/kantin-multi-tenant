<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_modifier_groups', function (Blueprint $table) {
            $table->foreignId('menu_id')
                ->constrained('menus')
                ->cascadeOnDelete();

            $table->foreignId('modifier_group_id')
                ->constrained('modifier_groups')
                ->cascadeOnDelete();

            $table->foreignId('tenant_id')
                ->constrained('tenants')
                ->cascadeOnDelete();

            $table->primary(['menu_id', 'modifier_group_id']);

            $table->index(
                ['tenant_id'],
                'menu_modifier_groups_tenant_id_index'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_modifier_groups');
    }
};