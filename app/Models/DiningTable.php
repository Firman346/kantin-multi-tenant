<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiningTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'canteen_id',
        'code',
        'label',
        'zone',
        'status',
    ];

    public function canteen()
    {
        return $this->belongsTo(Canteen::class);
    }
}