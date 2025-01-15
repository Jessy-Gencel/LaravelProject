<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            ProfilesSeeder::class,
            LeaderboardSeeder::class,
            TowerSeeder::class,
            NewsSeeder::class,
            FaqsSeeder::class,
            AchievementSeeder::class,
            ContactRequestsSeeder::class,
            CommentsSeeder::class,
            AchievementUserSeeder::class,
            EnemySeeder::class,
            ProfileCommentsSeeder::class,
        ]);
    }
}
