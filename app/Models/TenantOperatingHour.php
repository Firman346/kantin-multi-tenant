<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantOperatingHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'day',
        'opens_at',
        'closes_at',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}