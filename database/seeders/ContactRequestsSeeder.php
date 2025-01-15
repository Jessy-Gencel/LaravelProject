<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactRequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('contact_requests')->insert([
            [
                'id' => 20,
                'email' => 'jessy.gencel@student.ehb.be',
                'firstname' => 'Alfredo',
                'lastname' => 'Piazo',
                'message' => 'This is a formal test to see whether the admin mails and dashboard work.',
                'is_resolved' => true,
                'resolved_at' => '2025-01-01 23:49:45',
                'response' => 'The first portion of the test has successfully been concluded, let\'s now move to phase 2',
                'response_by' => 'admin',
                'created_at' => '2025-01-01 23:49:45',
                'updated_at' => '2025-01-01 23:44:02',
            ],
            [
                'id' => 22,
                'email' => 'jessygencel@hotmail.com',
                'firstname' => 'Jessy',
                'lastname' => 'Gencel',
                'message' => 'A second test with two separate email addresses to truly ensure everything works as intended.',
                'is_resolved' => true,
                'resolved_at' => '2025-01-01 23:53:30',
                'response' => 'This should send an email to my personal email address',
                'response_by' => 'admin',
                'created_at' => '2025-01-01 23:53:30',
                'updated_at' => '2025-01-01 23:52:30',
            ],
            [
                'id' => 23,
                'email' => 'jessygencel@hotmail.com',
                'firstname' => 'Jessy',
                'lastname' => 'Gencel',
                'message' => 'This is a test inquiry, please answer at your convenience',
                'is_resolved' => true,
                'resolved_at' => '2025-01-11 12:54:44',
                'response' => 'The test inquiry has been responded. I hope this proves that the contact answering page works without fail.',
                'response_by' => 'admin',
                'created_at' => '2025-01-11 12:54:44',
                'updated_at' => '2025-01-11 12:38:48',
            ],
            [
                'id' => 24,
                'email' => 'jessygencel@hotmail.com',
                'firstname' => 'Jessy',
                'lastname' => 'Gencel',
                'message' => 'test',
                'is_resolved' => false,
                'resolved_at' => null,
                'response' => null,
                'response_by' => null,
                'created_at' => null,
                'updated_at' => '2025-01-14 16:53:15',
            ],
        ]);
    }
}
