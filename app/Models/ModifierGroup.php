<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModifierGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'name',
        'min_select',
        'max_select',
    ];

    protected $casts = [
        'min_select' => 'integer',
        'max_select' => 'integer',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function options()
    {
        return $this->hasMany(ModifierOption::class);
    }

    public function menus()
    {
        return $this->belongsToMany(
            Menu::class,
            'menu_modifier_groups',
            'modifier_group_id',
            'menu_id'
        )->withPivot('tenant_id');
    }
}