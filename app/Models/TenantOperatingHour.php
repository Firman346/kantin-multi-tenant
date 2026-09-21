<?php

namespace App\Models;

use App\Support\Tenancy\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantOperatingHour extends Model
{
    use BelongsToTenant, HasFactory;

    protected $fillable = [
        'day',
        'opens_at',
        'closes_at',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
