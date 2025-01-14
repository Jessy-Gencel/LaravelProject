<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 2,
                'email' => 'jessygencel@hotmail.com',
                'email_verified_at' => null,
                'password' => '$2y$12$Bm0VyWDRiDa9Bp/.d3cKE.ZahSNn7vbiOfXX9lvMTlMz1DFW7WFKi',
                'remember_token' => 'ZmDSHFt1azIenJ20671EvI7aQMooL6cQqsQBtqBngCmbZJDqfApO2wTe9mhq',
                'created_at' => '2024-10-27 13:28:58',
                'updated_at' => '2025-01-11 16:40:01',
                'is_admin' => false,
                'blacklisted' => false,
                'password_reset_code' => null,
            ],
            [
                'id' => 3,
                'email' => 'second@test.com',
                'email_verified_at' => null,
                'password' => '$2y$12$IJaz0U.396EqxRiBSzVe2.8JZNMO78bvG9Le0b1ZLM2WMxQZ0E1uq',
                'remember_token' => null,
                'created_at' => '2024-11-20 16:44:34',
                'updated_at' => '2024-12-25 14:45:35',
                'is_admin' => false,
                'blacklisted' => false,
                'password_reset_code' => null,
            ],
            [
                'id' => 4,
                'email' => 'third@hotmail.com',
                'email_verified_at' => null,
                'password' => '$2y$12$3A7rMFsmmhGGTuQQ1DNQAuD/HQw7nGaxlfXqJv/uYDi5cdGQsTYm.',
                'remember_token' => null,
                'created_at' => '2024-11-20 16:50:23',
                'updated_at' => '2024-12-25 14:47:50',
                'is_admin' => false,
                'blacklisted' => false,
                'password_reset_code' => null,
            ],
            [
                'id' => 5,
                'email' => 'admin@ehb.be',
                'email_verified_at' => null,
                'password' => '$2y$12$KwZQ7FKob2bQDRZuItZZHuprQDvrOB3S0bYe7q.6EKENY4tJ67aye',
                'remember_token' => null,
                'created_at' => '2024-12-23 20:44:32',
                'updated_at' => '2024-12-23 20:59:44',
                'is_admin' => true,
                'blacklisted' => false,
                'password_reset_code' => null,
            ],
            [
                'id' => 8,
                'email' => 'testing@hotmail.com',
                'email_verified_at' => null,
                'password' => '$2y$12$u5oMtsCQPioatCkvfMSPcO8W5Ze6nGHJCBSOXL.kCX/.rmP2yC.Gi',
                'remember_token' => null,
                'created_at' => '2024-12-25 14:51:04',
                'updated_at' => '2025-01-13 12:51:35',
                'is_admin' => false,
                'blacklisted' => false,
                'password_reset_code' => null,
            ],
        ]);
    }
}
