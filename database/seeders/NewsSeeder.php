<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('news')->insert([
            [
                'id' => 1,
                'user_id' => 2,
                'title' => 'Release of Alien Defense 1.0',
                'image' => 'news_images/9804Fwc17hAKXgI6iRi2KGtIdi5ut46pP7Y5MnrY.jpg',
                'content' => 'The first release of Alien Defense is here. We hope you enjoy! :)',
                'created_at' => '2024-10-30 14:30:34',
                'updated_at' => '2024-10-30 14:30:34',
            ],
        ]);
    }
}
