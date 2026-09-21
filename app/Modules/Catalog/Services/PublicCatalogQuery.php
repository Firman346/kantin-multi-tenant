<?php

namespace App\Modules\Catalog\Services;

use App\Models\Menu;

class PublicCatalogQuery
{
    public function getForCanteen(int $canteenId)
    {
        return Menu::withoutGlobalScopes()
            ->where('canteen_id', $canteenId)
            ->where('is_available', true)
            ->get();
    }
}
