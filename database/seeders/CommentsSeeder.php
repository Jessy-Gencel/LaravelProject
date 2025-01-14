<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('comments')->insert([
            [
                'id' => 2,
                'user_id' => 1,
                'post_id' => 2,
                'comment' => 'I am really excited to play this game :) !!!',
                'created_at' => '2024-10-31 15:33:06',
                'updated_at' => '2024-10-31 15:33:06',
            ],
            [
                'id' => 4,
                'user_id' => 1,
                'post_id' => 2,
                'comment' => 'Can\'t wait for the next update!',
                'created_at' => '2025-01-11 12:40:46',
                'updated_at' => '2025-01-11 12:40:46',
            ],
        ]);
    }
}
