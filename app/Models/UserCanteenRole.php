<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCanteenRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'canteen_id',
        'role',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function canteen()
    {
        return $this->belongsTo(Canteen::class);
    }
}