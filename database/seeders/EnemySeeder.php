<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Enemy;

class EnemySeeder extends Seeder
{

    public function run(): void
    {
        Enemy::create([
            'name' => 'fledgeling',
            'type' => 'standard',
            'health' => 100,
            'speed' => 1.0,
            'score' => 100,
            'sprite' => 'fledgeling.png',
            'damage' => 10,
        ]);

        Enemy::create([
            'name' => 'fledgeling_runner',
            'type' => 'standard',
            'health' => 70,
            'speed' => 1.5,
            'score' => 100,
            'sprite' => 'fledgeling_runner.png',
            'damage' => 10,
        ]);

        Enemy::create([
            'name' => 'tank',
            'type' => 'standard',
            'health' => 300,
            'speed' => 0.5,
            'score' => 200,
            'sprite' => 'tank.png',
            'damage' => 10,
        ]);
        Enemy::create([
            'name' => 'fledgeling_spitter',
            'type' => 'ranged',	
            'health' => 60,
            'speed' => 1.0,
            'score' => 300,
            'sprite' => 'fledgeling_spitter.png',
            'damage' => 10,
            'projectile_sprite' => 'spit.png',
            'projectile_speed' => 1.0,
            'range' => 400,
        ]);
        Enemy::create([
            'name' => 'priest',
            'type' => 'healer',	
            'health' => 40,
            'speed' => 0.5,
            'score' => 300,
            'sprite' => 'priest.png',
            'damage' => 0,
            'projectile_speed' => 4.0,
            'range' => 200,
            'heal_amount' => 10,
        ]);
    }
}
