<?php

namespace App\Models;

use App\Support\Tenancy\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LedgerEntry extends Model
{
    use BelongsToTenant, HasFactory;

    protected $fillable = [
        'payment_id',
        'withdrawal_id',
        'idempotency_key',
        'type',
        'amount',
        'available_at',
        'held_until',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'available_at' => 'datetime',
        'held_until' => 'datetime',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function withdrawal()
    {
        return $this->belongsTo(Withdrawal::class);
    }
}
