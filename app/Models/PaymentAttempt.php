<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'provider_reference',
        'attempt_no',
        'status',
    ];

    protected $casts = [
        'attempt_no' => 'integer',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function events()
    {
        return $this->hasMany(PaymentEvent::class);
    }
}