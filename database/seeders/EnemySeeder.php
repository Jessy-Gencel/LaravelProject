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
            'health' => 100,
            'speed' => 1.0,
            'score' => 100,
            'sprite' => 'fledgeling.png',
            'damage' => 10,
        ]);

        Enemy::create([
            'name' => 'fledgeling_runner',
            'health' => 70,
            'speed' => 1.5,
            'score' => 100,
            'sprite' => 'fledgeling_runner.png',
            'damage' => 10,
        ]);

        Enemy::create([
            'name' => 'tank',
            'health' => 300,
            'speed' => 0.5,
            'score' => 200,
            'sprite' => 'tank.png',
            'damage' => 10,
        ]);
    }
}
