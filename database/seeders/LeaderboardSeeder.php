<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Leaderboard;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LeaderboardSeeder extends Seeder
{
    public function run()
    {
        DB::table('leaderboards')->insert([
            [
                'id' => 1,
                'user_id' => 2,
                'highscore' => 3450,
                'created_at' => '2024-10-27 13:28:58',
                'updated_at' => '2024-10-27 15:00:00', // Score updated after creation
            ],
            [
                'id' => 2,
                'user_id' => 3,
                'highscore' => 2450,
                'created_at' => '2024-11-20 16:44:34',
                'updated_at' => '2024-11-20 17:30:00', // Score updated after creation
            ],
            [
                'id' => 3,
                'user_id' => 4,
                'highscore' => 11000, // Higher score
                'created_at' => '2024-11-20 16:50:23',
                'updated_at' => '2024-11-20 18:00:00', // Score updated after creation
            ],
            [
                'id' => 4,
                'user_id' => 5,
                'highscore' => 4800,
                'created_at' => '2024-12-23 20:44:32',
                'updated_at' => '2024-12-23 21:15:00', // Score updated after creation
            ],
            [
                'id' => 5,
                'user_id' => 8,
                'highscore' => 3200,
                'created_at' => '2024-12-25 14:51:04',
                'updated_at' => '2024-12-25 15:30:00', // Score updated after creation
            ],
        ]);
    }
}
