<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuStockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'order_item_id',
        'idempotency_key',
        'type',
        'quantity_delta',
    ];

    protected $casts = [
        'quantity_delta' => 'integer',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
}