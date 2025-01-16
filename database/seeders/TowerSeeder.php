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
            'damage' => 20,
            'hitpoints' => 100,
            'fire_rate' => 3000,
            'rotation_angle' => -90,
            'range' => null,
            'projectile_speed' => 1
        ]);
        Tower::create([
            'name' => 'Combustion Tower',
            'price' => 300,
            'sprite_image' => 'combustion_tower.png',
            'projectile_image' => 'combustion_projectile.png',
            'damage' => 50,
            'hitpoints' => 100,
            'fire_rate' => 3000,
            'rotation_angle' => 90,
            'range' => null,
            'projectile_speed' => 1
        ]);
        Tower::create([
            'name' => 'Gatling Tower',
            'price' => 500,
            'sprite_image' => 'gatling_tower.png',
            'projectile_image' => 'gatling_projectile.png',
            'damage' => 15,
            'hitpoints' => 150,
            'fire_rate' => 750,
            'rotation_angle' => 90,
            'range' => null,
            'projectile_speed' => 3
        ]);
        Tower::create([
            'name' => 'Infernal Tower',
            'price' => 1000,
            'sprite_image' => 'infernal_tower.png',
            'projectile_image' => 'infernal_projectile.png',
            'damage' => 50,
            'hitpoints' => 150,
            'fire_rate' => 1000,
            'rotation_angle' => 90,
            'range' => null,
            'projectile_speed' => 1
        ]);
        Tower::create([
            'name' => 'Juggernaut_Slayer Tower',
            'price' => 6000,
            'sprite_image' => 'juggernaut_slayer_tower.png',
            'projectile_image' => 'juggernaut_slayer_projectile.png',
            'damage' => 2500,
            'hitpoints' => 500,
            'fire_rate' => 1500,
            'rotation_angle' => 90,
            'range' => null,
            'projectile_speed' => 5
        ]);
        
    }
}
