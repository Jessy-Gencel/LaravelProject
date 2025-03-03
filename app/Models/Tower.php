<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tower extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'sprite_image',
        'projectile_image',
        'damage',
        'hitpoints',
        'fire_rate',
        'rotation_angle',
        'range',
        'projectile_speed'
    ];
}

