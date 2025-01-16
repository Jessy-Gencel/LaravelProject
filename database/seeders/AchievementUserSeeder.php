<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AchievementUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('achievement_user')->insert([
            // User 2
            [
                'id' => 1,
                'user_id' => 2,
                'achievement_id' => 1, // Beginner
                'awarded_at' => '2024-10-27 13:30:00',
                'created_at' => '2024-10-27 13:30:00',
                'updated_at' => '2024-10-27 13:30:00',
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'achievement_id' => 2, // Explorer
                'awarded_at' => '2024-10-27 13:40:00',
                'created_at' => '2024-10-27 13:40:00',
                'updated_at' => '2024-10-27 13:40:00',
            ],
            [
                'id' => 3,
                'user_id' => 2,
                'achievement_id' => 3, // Alien Guardrail
                'awarded_at' => '2024-10-27 15:10:00',
                'created_at' => '2024-10-27 15:10:00',
                'updated_at' => '2024-10-27 15:10:00',
            ],

            // User 3
            [
                'id' => 4,
                'user_id' => 3,
                'achievement_id' => 1, // Beginner
                'awarded_at' => '2024-11-20 16:45:00',
                'created_at' => '2024-11-20 16:45:00',
                'updated_at' => '2024-11-20 16:45:00',
            ],
            [
                'id' => 5,
                'user_id' => 3,
                'achievement_id' => 2, // Explorer
                'awarded_at' => '2024-11-20 17:00:00',
                'created_at' => '2024-11-20 17:00:00',
                'updated_at' => '2024-11-20 17:00:00',
            ],
            [
                'id' => 6,
                'user_id' => 3,
                'achievement_id' => 3, // Alien Guardrail
                'awarded_at' => '2024-11-20 17:40:00',
                'created_at' => '2024-11-20 17:40:00',
                'updated_at' => '2024-11-20 17:40:00',
            ],

            // User 4
            [
                'id' => 7,
                'user_id' => 4,
                'achievement_id' => 1, // Beginner
                'awarded_at' => '2024-11-20 16:55:00',
                'created_at' => '2024-11-20 16:55:00',
                'updated_at' => '2024-11-20 16:55:00',
            ],
            [
                'id' => 8,
                'user_id' => 4,
                'achievement_id' => 2, // Explorer
                'awarded_at' => '2024-11-20 17:05:00',
                'created_at' => '2024-11-20 17:05:00',
                'updated_at' => '2024-11-20 17:05:00',
            ],
            [
                'id' => 9,
                'user_id' => 4,
                'achievement_id' => 3, // Alien Guardrail
                'awarded_at' => '2024-11-20 17:35:00',
                'created_at' => '2024-11-20 17:35:00',
                'updated_at' => '2024-11-20 17:35:00',
            ],
            [
                'id' => 10,
                'user_id' => 4,
                'achievement_id' => 4, // Alien Bastion
                'awarded_at' => '2024-11-20 18:10:00',
                'created_at' => '2024-11-20 18:10:00',
                'updated_at' => '2024-11-20 18:10:00',
            ],
            [
                'id' => 11,
                'user_id' => 4,
                'achievement_id' => 5, // Juggernaut slayer
                'awarded_at' => '2024-11-20 18:40:00',
                'created_at' => '2024-11-20 18:40:00',
                'updated_at' => '2024-11-20 18:40:00',
            ],

            // User 5
            [
                'id' => 12,
                'user_id' => 5,
                'achievement_id' => 1, // Beginner
                'awarded_at' => '2024-12-23 20:50:00',
                'created_at' => '2024-12-23 20:50:00',
                'updated_at' => '2024-12-23 20:50:00',
            ],
            [
                'id' => 13,
                'user_id' => 5,
                'achievement_id' => 2, // Explorer
                'awarded_at' => '2024-12-24 20:00:00',
                'created_at' => '2024-12-24 20:00:00',
                'updated_at' => '2024-12-24 20:00:00',
            ],
            [
                'id' => 14,
                'user_id' => 5,
                'achievement_id' => 3, // Alien Guardrail
                'awarded_at' => '2024-12-23 21:20:00',
                'created_at' => '2024-12-23 21:20:00',
                'updated_at' => '2024-12-23 21:20:00',
            ],

            // User 8
            [
                'id' => 15,
                'user_id' => 8,
                'achievement_id' => 1, // Beginner
                'awarded_at' => '2024-12-25 14:55:00',
                'created_at' => '2024-12-25 14:55:00',
                'updated_at' => '2024-12-25 14:55:00',
            ],
            [
                'id' => 16,
                'user_id' => 8,
                'achievement_id' => 2, // Explorer
                'awarded_at' => '2024-12-26 20:00:00',
                'created_at' => '2024-12-26 20:00:00',
                'updated_at' => '2024-12-26 20:00:00',
            ],
            [
                'id' => 17,
                'user_id' => 8,
                'achievement_id' => 3, // Alien Guardrail
                'awarded_at' => '2024-12-26 21:35:00',
                'created_at' => '2024-12-26 21:35:00',
                'updated_at' => '2024-12-26 21:35:00',
            ],
        ]);
    }
}
