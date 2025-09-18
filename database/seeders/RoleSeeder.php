<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'Admin', 'guard_name' => 'web', 'created_at' => '2025-09-08 15:17:06', 'updated_at' => '2025-09-08 15:17:06'],
            ['id' => 2, 'name' => 'User', 'guard_name' => 'web', 'created_at' => '2025-09-08 15:17:06', 'updated_at' => '2025-09-08 15:17:06'],
            ['id' => 3, 'name' => 'Manager', 'guard_name' => 'web', 'created_at' => '2025-09-10 13:28:59', 'updated_at' => '2025-09-10 13:28:59'],
            ['id' => 4, 'name' => 'Editor', 'guard_name' => 'web', 'created_at' => '2025-09-10 15:10:09', 'updated_at' => '2025-09-10 15:10:09'],
            ['id' => 7, 'name' => 'Sales', 'guard_name' => 'web', 'created_at' => '2025-09-10 15:32:30', 'updated_at' => '2025-09-10 15:32:30'],
        ]);
    }
}
