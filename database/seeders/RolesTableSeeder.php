<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        if (!Role::where('name', 'Trucker')->exists()) {
            Role::create(['name' => 'Trucker', 'guard_name' => 'web']);
        }

        if (!Role::where('name', 'Civilian')->exists()) {
            Role::create(['name' => 'Civilian', 'guard_name' => 'web']);
        }
    }
}
