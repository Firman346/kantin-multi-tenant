<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'actor_id',
        'tenant_id',
        'entity_type',
        'entity_id',
        'action',
        'request_id',
        'before',
        'after',
    ];

    protected $casts = [
        'entity_id' => 'integer',
        'before' => 'array',
        'after' => 'array',
    ];

    public function actor()
    {
        return $this->belongsTo(User::class, 'actor_id');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}