<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutboxEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_key',
        'aggregate_type',
        'aggregate_id',
        'event_type',
        'payload',
        'published_at',
    ];

    protected $casts = [
        'aggregate_id' => 'integer',
        'payload' => 'array',
        'published_at' => 'datetime',
    ];

    public function notificationDeliveries()
    {
        return $this->hasMany(NotificationDelivery::class);
    }
}