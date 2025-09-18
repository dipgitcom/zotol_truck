<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Dipraj Dhar',
                'email' => 'admin@example.com',
                'profile_photo' => null, // or provide a filename/path
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
                'email_otp' => null,
                'email_otp_expires_at' => null,
                'password_reset_otp' => null,
                'password_reset_expires_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Test User',
                'email' => 'testuser@example.com',
                'profile_photo' => null,
                'email_verified_at' => now(),
                'password' => Hash::make('testpassword'),
                'remember_token' => Str::random(10),
                'email_otp' => null,
                'email_otp_expires_at' => null,
                'password_reset_otp' => null,
                'password_reset_expires_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
