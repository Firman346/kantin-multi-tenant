<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'public_order_number',
        'customer_session_id',
        'checkout_key',
        'tracking_token_hash',
        'status',
        'subtotal',
        'tax_total',
        'service_fee_total',
        'grand_total',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax_total' => 'decimal:2',
        'service_fee_total' => 'decimal:2',
        'grand_total' => 'decimal:2',
    ];

    public function customerSession()
    {
        return $this->belongsTo(CustomerSession::class);
    }

    public function tenantOrders()
    {
        return $this->hasMany(TenantOrder::class);
    }
}