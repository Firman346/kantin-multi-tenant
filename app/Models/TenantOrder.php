<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'tenant_id',
        'commission_id',
        'status',
        'scheduled_at',
        'subtotal',
        'tax_total',
        'service_fee_total',
        'commission_total',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'subtotal' => 'decimal:2',
        'tax_total' => 'decimal:2',
        'service_fee_total' => 'decimal:2',
        'commission_total' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function commission()
    {
        return $this->belongsTo(CommissionSchema::class, 'commission_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}