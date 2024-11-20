<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Leaderboard;
use App\Models\User;

class LeaderboardSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            Leaderboard::create([
                'user_id' => $user->id,       
                'highscore' => rand(100, 1000),
            ]);
        }
    }
}
