<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModifierOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'modifier_group_id',
        'name',
        'price_delta',
        'stock_qty',
        'is_available',
    ];

    protected $casts = [
        'price_delta' => 'decimal:2',
        'stock_qty' => 'integer',
        'is_available' => 'boolean',
    ];

    public function modifierGroup()
    {
        return $this->belongsTo(ModifierGroup::class);
    }
}