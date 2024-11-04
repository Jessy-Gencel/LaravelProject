<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enemy extends Model
{
    protected $fillable = [
        'name',
        'health',
        'speed',
        'damage',
        'score',
        'sprite',
        'sound',
        'projectile_sprite',
        'projectile_sound',
        'projectile_speed',
    ];
}
