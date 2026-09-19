<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemModifier extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_item_id',
        'modifier_group_id',
        'modifier_option_id',
        'price_delta',
    ];

    protected $casts = [
        'price_delta' => 'decimal:2',
    ];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function modifierGroup()
    {
        return $this->belongsTo(ModifierGroup::class);
    }

    public function modifierOption()
    {
        return $this->belongsTo(ModifierOption::class);
    }
}