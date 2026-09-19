<?php

namespace Database\Seeders;

use App\Models\Canteen;
use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\MenuModifierGroup;
use App\Models\ModifierGroup;
use App\Models\ModifierOption;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class DemoCanteenSeeder extends Seeder
{
    public function run(): void
    {
        // Canteen demo
        $canteen = Canteen::firstOrCreate(
            ['code' => 'CANTEEN-DEMO'],
            [
                'slug' => 'canteen-demo',
                'tax_rate' => 11.00,
                'service_fee_rate' => 5.00,
                'status' => 'aktif',
            ]
        );

        // Tenant demo dalam canteen yang sama
        $tenant = Tenant::firstOrCreate(
            [
                'canteen_id' => $canteen->id,
                'code' => 'TEN-DEMO',
            ],
            [
                'name' => 'Tenant Demo',
                'slug' => 'tenant-demo',
                'status' => 'aktif',
            ]
        );

        // Kategori menu
        $category = MenuCategory::firstOrCreate(
            [
                'tenant_id' => $tenant->id,
                'name' => 'Makanan',
            ],
            [
                'sort_order' => 1,
                'active' => true,
            ]
        );

        // Menu demo
        $menu = Menu::firstOrCreate(
            [
                'tenant_id' => $tenant->id,
                'name' => 'Nasi Goreng',
            ],
            [
                'category_id' => $category->id,
                'base_price' => 15000,
                'stock_qty' => 50,
                'is_available' => true,
            ]
        );

        // Grup modifier
        $modifierGroup = ModifierGroup::firstOrCreate(
            [
                'tenant_id' => $tenant->id,
                'name' => 'Level Pedas',
            ],
            [
                'min_select' => 0,
                'max_select' => 1,
            ]
        );

        // Pilihan modifier
        ModifierOption::firstOrCreate(
            [
                'modifier_group_id' => $modifierGroup->id,
                'name' => 'Tidak Pedas',
            ],
            [
                'price_delta' => 0,
                'stock_qty' => 50,
                'is_available' => true,
            ]
        );

        ModifierOption::firstOrCreate(
            [
                'modifier_group_id' => $modifierGroup->id,
                'name' => 'Pedas',
            ],
            [
                'price_delta' => 2000,
                'stock_qty' => 50,
                'is_available' => true,
            ]
        );

        // Hubungkan menu dengan modifier group
        MenuModifierGroup::firstOrCreate(
            [
                'menu_id' => $menu->id,
                'modifier_group_id' => $modifierGroup->id,
            ],
            [
                'tenant_id' => $tenant->id,
            ]
        );
    }
}