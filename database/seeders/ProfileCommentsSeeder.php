<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileCommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('profile_comments')->insert([
            [
                'id' => 1,
                'user_id' => 2,
                'profile_id' => 4,
                'content' => 'This guy is amazing at this game!',
                'created_at' => '2025-01-15 14:30:34',
                'updated_at' => '2025-01-15 14:30:34',
            ],
        ]);
        
    }
}
