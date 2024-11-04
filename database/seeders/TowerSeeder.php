<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tower;
use Illuminate\Support\Facades\DB;

class TowerSeeder extends Seeder
{
    public function run()
    {
        Tower::create([
            'name' => 'Basic Tower',
            'price' => 100,
            'sprite_image' => 'basic_tower.png',
            'projectile_image' => 'basic_projectile.png',
            'damage' => 10,
            'hitpoints' => 100,
            'fire_rate' => 1,
            'rotation_angle' => -90,
            'range' => null,
            'projectile_speed' => 1
        ]);
        Tower::create([
            'name' => 'Combustion Tower',
            'price' => 150,
            'sprite_image' => 'combustion_tower.png',
            'projectile_image' => 'combustion_projectile.png',
            'damage' => 15,
            'hitpoints' => 100,
            'fire_rate' => 1,
            'rotation_angle' => 90,
            'range' => null,
            'projectile_speed' => 1
        ]);
        
    }
}
