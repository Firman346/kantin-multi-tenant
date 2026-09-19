<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canteen extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'slug',
        'tax_rate',
        'service_fee_rate',
        'status',
    ];
}