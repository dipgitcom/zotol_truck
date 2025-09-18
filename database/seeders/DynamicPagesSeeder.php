<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DynamicPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dynamic_pages')->insert([
            [
                'id' => 1,
                'title' => 'About Us',
                'slug' => 'about-us',
                'content' => 'This is a dashuipro .',
                'created_at' => '2025-09-06 16:10:24',
                'updated_at' => '2025-09-06 16:10:24',
            ],
            [
                'id' => 2,
                'title' => 'Contact me',
                'slug' => 'contact',
                'content' => "contact no - 01xxxxxxxxx\r\naddress- Dhaka,Moahakhali",
                'created_at' => '2025-09-06 16:45:16',
                'updated_at' => '2025-09-06 16:45:16',
            ],
            [
                'id' => 3,
                'title' => 'Privacy Policy',
                'slug' => 'privacy',
                'content' => 'This is privacy policy page',
                'created_at' => '2025-09-12 17:10:46',
                'updated_at' => '2025-09-12 17:10:46',
            ],
        ]);
    }
}
