<?php

namespace App\Models;

use App\Support\Tenancy\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionSchema extends Model
{
    use BelongsToTenant, HasFactory;

    protected $fillable = [
        'commission_rate',
        'valid_from',
        'valid_to',
    ];

    protected $casts = [
        'commission_rate' => 'decimal:2',
        'valid_from' => 'datetime',
        'valid_to' => 'datetime',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
