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
            'attack_speed' => 1.0,
        ]);

        Enemy::create([
            'name' => 'fledgeling_runner',
            'type' => 'standard',
            'health' => 70,
            'speed' => 2.0,
            'score' => 100,
            'sprite' => 'fledgeling_runner.png',
            'damage' => 10,
            'attack_speed' => 1.0,
        ]);

        Enemy::create([
            'name' => 'tank',
            'type' => 'standard',
            'health' => 400,
            'speed' => 0.5,
            'score' => 200,
            'sprite' => 'tank.png',
            'damage' => 10,
            'attack_speed' => 1.0,
        ]);

        Enemy::create([
            'name' => 'fledgeling_spitter',
            'type' => 'ranged',	
            'health' => 80,
            'speed' => 1.0,
            'score' => 300,
            'sprite' => 'fledgeling_spitter.png',
            'damage' => 10,
            'attack_speed' => 1.0,
            'projectile_sprite' => 'spit.png',
            'projectile_speed' => 1.0,
            'range' => 400,
            'fire_rate' => 3.0,
        ]);

        Enemy::create([
            'name' => 'priest',
            'type' => 'healer',	
            'health' => 60,
            'speed' => 0.5,
            'score' => 300,
            'sprite' => 'priest.png',
            'damage' => 0,
            'attack_speed' => 4.0,
            'heal_amount' => 10,
            'heal_rate' => 4.0,
            'heal_range' => 200,
        ]);

        Enemy::create([
            'name' => 'barrier_conjurer',
            'type' => 'barrier',	
            'health' => 60,
            'speed' => 0.8,
            'score' => 500,
            'sprite' => 'barrier_conjurer.png',
            'damage' => 10,
            'attack_speed' => 1.0,
            'barrier_health' => 200,
            'barrier_cooldown' => 4.0,
            'barrier_regen' => 10,
            'barrier_regen_cooldown' => 1.0,
            'barrier_radius' => 80,
        ]);
        Enemy::create([
            'name' => 'minion',
            'type' => 'standard',
            'health' => 20,
            'speed' => 1.5,
            'score' => 0,
            'sprite' => 'minion.png',
            'damage' => 10,
            'attack_speed' => 1.0,
        ]);
        Enemy::create([
            'name' => 'breeder',
            'type' => 'spawner',
            'health' => 150,
            'speed' => 0.3,
            'score' => 1000,
            'sprite' => 'breeder.png',
            'damage' => 10,
            'attack_speed' => 0.5,
            'spawn_rate' => 3.0,
        ]);
        Enemy::create([
            'name' => 'inquisitor',
            'type' => 'inquisitor',
            'health' => 120,
            'speed' => 0.8,
            'score' => 1500,
            'sprite' => 'inquisitor.png',
            'damage' => 20,
            'attack_speed' => 1.5,
            'barrier_health' => 300,
            'barrier_cooldown' => 2.0,
            'barrier_regen' => 50,
            'barrier_regen_cooldown' => 1.0,
            'barrier_radius' => 80,
        ]);
        Enemy::create([
            'name' => 'reverend',
            'type' => 'teleporter',
            'health' => 500,
            'speed' => 0.8,
            'score' => 1000,
            'sprite' => 'reverend.png',
            'damage' => 10,
            'attack_speed' => 1.0,
        ]);
        Enemy::create([
            'name' => 'shadower',
            'type' => 'cloaked',
            'health' => 150,
            'speed' => 0.6,
            'score' => 1500,
            'sprite' => 'shadower.png',
            'damage' => 20,
            'attack_speed' => 1.0,
            'cloak_duration' => 5.0,
            'cloak_cooldown' => 3.5,
            'timer_based' => true,
        ]);
        Enemy::create([
            'name' => 'stalker',
            'type' => 'stalker',
            'health' => 200,
            'speed' => 0.8,
            'score' => 2000,
            'sprite' => 'stalker.png',
            'damage' => 20,
            'attack_speed' => 1.0,
            'cloak_radius' => 500,
            'proximity_based' => true,
            'projectile_sprite' => 'spit.png',
            'projectile_speed' => 1.0,
            'range' => 300,
            'fire_rate' => 3.0,
        ]);
        Enemy::create([
            'name' => 'juggernaut',
            'type' => 'juggernaut',
            'health' => 12500,
            'speed' => 0.2,
            'score' => 100000,
            'sprite' => 'juggernaut.png',
            'damage' => 50,
            'attack_speed' => 0.3,
            'cloak_duration' => 5.0,
            'cloak_cooldown' => 15.0,
            'timer_based' => true,
            'barrier_health' => 5000,
            'barrier_cooldown' => 7.0,
            'barrier_regen' => 250,
            'barrier_regen_cooldown' => 3.0,
            'barrier_radius' => 300,
        ]);
    }
}
