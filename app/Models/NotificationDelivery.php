<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationDelivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'outbox_event_id',
        'key',
        'channel',
        'status',
        'attempts',
        'sent_at',
        'last_error',
    ];

    protected $casts = [
        'attempts' => 'integer',
        'sent_at' => 'datetime',
    ];

    public function outboxEvent()
    {
        return $this->belongsTo(OutboxEvent::class);
    }
}