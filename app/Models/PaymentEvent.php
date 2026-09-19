<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'payment_attempt_id',
        'provider_event_id',
        'signature',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function paymentAttempt()
    {
        return $this->belongsTo(PaymentAttempt::class);
    }
}