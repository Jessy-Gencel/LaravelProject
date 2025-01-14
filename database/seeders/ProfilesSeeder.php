<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('profiles')->insert([
            [
                'id' => 1,
                'user_id' => 2,
                'username' => 'Primordial666',
                'birthday' => '2008-12-09',
                'pfp' => '1730150478.webp',
                'about_me' => 'I am inevitable',
                'created_at' => '2024-10-27 13:28:58',
                'updated_at' => '2024-10-28 21:21:18',
            ],
            [
                'id' => 2,
                'user_id' => 3,
                'username' => 'Kuro',
                'birthday' => '2005-03-01',
                'pfp' => '1732121194.jpg',
                'about_me' => 'Hello, I am a new user!',
                'created_at' => '2024-11-20 16:44:34',
                'updated_at' => '2024-11-20 16:46:34',
            ],
            [
                'id' => 3,
                'user_id' => 4,
                'username' => 'Garry',
                'birthday' => '1993-05-12',
                'pfp' => '1732121499.png',
                'about_me' => 'Hello, I am a new user!',
                'created_at' => '2024-11-20 16:50:23',
                'updated_at' => '2024-11-20 16:51:39',
            ],
            [
                'id' => 4,
                'user_id' => 5,
                'username' => 'admin',
                'birthday' => '2002-08-14',
                'pfp' => '1735644964.png',
                'about_me' => 'Standard test user for admin functionality',
                'created_at' => '2024-12-23 20:44:32',
                'updated_at' => '2024-12-31 11:36:04',
            ],
            [
                'id' => 9,
                'user_id' => 8,
                'username' => 'Frederick',
                'birthday' => '2000-12-08',
                'pfp' => '1735138264.png',
                'about_me' => 'Hello, I am a new user!',
                'created_at' => '2025-01-13 14:41:58',
                'updated_at' => '2025-01-13 14:41:58',
            ],
        ]);
    }

}
