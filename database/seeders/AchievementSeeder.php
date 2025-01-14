<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Achievement;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Achievement::insert([
            ['name' => 'Beginner', 'description' => 'Awarded for signing up.', 'icon_path' => 'badges/beginner.png', 'color' => '#A3D5FF', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Explorer', 'description' => 'Awarded for completing your profile.', 'icon_path' => 'badges/explorer.png', 'color' => '#FFD580', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alien Guardrail', 'description' => 'Awarded for reaching a score of 2000.', 'icon_path' => 'badges/alien_guardrail.png', 'color' => '#C3FFA3', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alien Bastion', 'description' => 'Awarded for reaching a score of 5000.', 'icon_path' => 'badges/alien_bastion.png', 'color' => '#FFB3B3', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Juggernaut Slayer', 'description' => 'Awarded for killing the juggernaut.', 'icon_path' => 'badges/juggernaut_slayer.png', 'color' => '#D5A3FF', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
