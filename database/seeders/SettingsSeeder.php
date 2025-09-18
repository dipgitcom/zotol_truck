<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            [
                'id' => 18,
                'key' => 'APP_LOGO',
                'value' => '/storage/uploads/AbWB0b2HNbVRbzUdhztlqfArHbd6rU00RWw4zpGv.jpg',
                'created_at' => '2025-09-12 11:39:05',
                'updated_at' => '2025-09-12 11:39:05',
            ],
            [
                'id' => 19,
                'key' => 'APP_FAVICON',
                'value' => 'backend/uploads/settings/favicon.png',
                'created_at' => '2025-09-12 11:39:05',
                'updated_at' => '2025-09-12 11:39:05',
            ],
            [
                'id' => 20,
                'key' => 'APP_NAME',
                'value' => 'AdminX',
                'created_at' => '2025-09-12 11:39:05',
                'updated_at' => '2025-09-12 11:39:05',
            ],
            [
                'id' => 21,
                'key' => 'APP_URL',
                'value' => 'http://localhost:8000',
                'created_at' => '2025-09-12 11:39:05',
                'updated_at' => '2025-09-12 11:39:05',
            ],
            [
                'id' => 22,
                'key' => 'APP_DEBUG',
                'value' => 'true',
                'created_at' => '2025-09-12 11:39:05',
                'updated_at' => '2025-09-12 11:39:05',
            ],
        ]);
    }
}
