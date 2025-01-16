<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('faqs')->insert([
            [
                'id' => 6,
                'user_id' => 5,
                'category' => 'General',
                'question' => 'How did this project come to be?',
                'description' => null,
                'answer' => 'The project started out as an assignment for one of my classes. I intend to continue working on it with an eventual Steam release in the future.',
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 13,
                'user_id' => 5,
                'category' => 'Pricing',
                'question' => 'Will Alien Defense ever switch to a paid version?',
                'description' => null,
                'answer' => 'The browser version of Alien Defense will always remain free of charge, there are plans for an eventual Steam release with a massive batch of new content. This newer version would be priced at a reasonable selling point.',
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 17,
                'user_id' => 2,
                'category' => 'General',
                'question' => 'How much content is there in Alien Defense?',
                'description' => "I'm just curious about how much content there is in the game. Like how many towers, enemies, and levels are there?",
                'answer' => null,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 18,
                'user_id' => 5,
                'category' => 'Contact',
                'question' => 'How can I contact Alien Defense for business inquiries?',
                'description' => null,
                'answer' => 'You can send a contact request via our contact page. This will allow you to specify your request. Admins of Alien Defense will then receive this contact request and pass on the information to the relevant parties.',
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
