<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_order_id',
        'menu_id',
        'name',
        'price',
        'quantity',
        'modifier_total',
        'line_total',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
        'modifier_total' => 'decimal:2',
        'line_total' => 'decimal:2',
    ];

    public function tenantOrder()
    {
        return $this->belongsTo(TenantOrder::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function modifiers()
    {
        return $this->hasMany(OrderItemModifier::class);
    }
}