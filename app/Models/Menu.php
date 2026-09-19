<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'category_id',
        'name',
        'base_price',
        'stock_qty',
        'is_available',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'stock_qty' => 'integer',
        'is_available' => 'boolean',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function category()
    {
        return $this->belongsTo(MenuCategory::class, 'category_id');
    }

    public function modifierGroups()
    {
        return $this->belongsToMany(
            ModifierGroup::class,
            'menu_modifier_groups',
            'menu_id',
            'modifier_group_id'
        )->withPivot('tenant_id');
    }
}