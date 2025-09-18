<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles first
        $this->call(RoleSeeder::class);
        // Seed users next
        $this->call(UserSeeder::class);
        // Seed other necessary data
        $this->call(CategorySeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleHasPermissionSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(DynamicPagesSeeder::class);
        $this->call(SettingsSeeder::class);

        // Seed a test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
