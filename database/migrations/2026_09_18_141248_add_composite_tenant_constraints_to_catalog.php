<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
         * Hapus foreign key lama terlebih dahulu.
         * FK lama hanya mengecek ID tanpa memastikan tenant yang sama.
         */
        Schema::table('menus', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        Schema::table('menu_modifier_groups', function (Blueprint $table) {
            $table->dropForeign(['menu_id']);
            $table->dropForeign(['modifier_group_id']);
        });

        /*
         * Tambahkan composite unique key.
         * Key ini diperlukan agar composite foreign key
         * dapat mereferensikan tenant_id + id.
         */
        Schema::table('menu_categories', function (Blueprint $table) {
            $table->unique(
                ['tenant_id', 'id'],
                'menu_categories_tenant_id_id_unique'
            );
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->unique(
                ['tenant_id', 'id'],
                'menus_tenant_id_id_unique'
            );
        });

        Schema::table('modifier_groups', function (Blueprint $table) {
            $table->unique(
                ['tenant_id', 'id'],
                'modifier_groups_tenant_id_id_unique'
            );
        });

        /*
         * Menu hanya boleh menggunakan kategori
         * dari tenant yang sama.
         */
        Schema::table('menus', function (Blueprint $table) {
            $table->foreign(
                ['tenant_id', 'category_id'],
                'menus_tenant_category_foreign'
            )
                ->references(['tenant_id', 'id'])
                ->on('menu_categories')
                ->restrictOnDelete();
        });

        /*
         * Menu dan modifier group harus berasal
         * dari tenant yang sama.
         */
        Schema::table('menu_modifier_groups', function (Blueprint $table) {
            $table->foreign(
                ['tenant_id', 'menu_id'],
                'menu_modifier_groups_tenant_menu_foreign'
            )
                ->references(['tenant_id', 'id'])
                ->on('menus')
                ->cascadeOnDelete();

            $table->foreign(
                ['tenant_id', 'modifier_group_id'],
                'menu_modifier_groups_tenant_modifier_group_foreign'
            )
                ->references(['tenant_id', 'id'])
                ->on('modifier_groups')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        /*
         * Hapus composite foreign key.
         */
        Schema::table('menu_modifier_groups', function (Blueprint $table) {
            $table->dropForeign(
                'menu_modifier_groups_tenant_menu_foreign'
            );

            $table->dropForeign(
                'menu_modifier_groups_tenant_modifier_group_foreign'
            );
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->dropForeign(
                'menus_tenant_category_foreign'
            );
        });

        /*
         * Hapus composite unique key.
         */
        Schema::table('menu_categories', function (Blueprint $table) {
            $table->dropUnique(
                'menu_categories_tenant_id_id_unique'
            );
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->dropUnique(
                'menus_tenant_id_id_unique'
            );
        });

        Schema::table('modifier_groups', function (Blueprint $table) {
            $table->dropUnique(
                'modifier_groups_tenant_id_id_unique'
            );
        });

        /*
         * Kembalikan foreign key sederhana
         * seperti sebelum migration ini.
         */
        Schema::table('menus', function (Blueprint $table) {
            $table->foreign('category_id')
                ->references('id')
                ->on('menu_categories')
                ->cascadeOnDelete();
        });

        Schema::table('menu_modifier_groups', function (Blueprint $table) {
            $table->foreign('menu_id')
                ->references('id')
                ->on('menus')
                ->cascadeOnDelete();

            $table->foreign('modifier_group_id')
                ->references('id')
                ->on('modifier_groups')
                ->cascadeOnDelete();
        });
    }
};