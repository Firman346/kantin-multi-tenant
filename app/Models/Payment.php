<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'idempotency_key',
        'provider_reference',
        'amount',
        'status',
        'settled_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'settled_at' => 'datetime',
    ];

    public function attempts()
    {
        return $this->hasMany(PaymentAttempt::class);
    }

    public function events()
    {
        return $this->hasMany(PaymentEvent::class);
    }
}