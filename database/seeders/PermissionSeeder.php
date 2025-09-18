<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Define granular permissions for each module
        $permissions = [
            // Users
            'user_view',
            'user_create',
            'user_edit',
            'user_delete',

            // Roles
            'role_view',
            'role_create',
            'role_edit',
            'role_delete',

            // Categories
            'category_view',
            'category_create',
            'category_edit',
            'category_delete',

            // FAQs
            'faq_view',
            'faq_create',
            'faq_edit',
            'faq_delete',

            // Dynamic Pages
            'dynamic_view',
            'dynamic_create',
            'dynamic_edit',
            'dynamic_delete',

            // Settings
            'settings_manage',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $userRole  = Role::firstOrCreate(['name' => 'User']);

        // Assign all permissions to Admin
        $adminRole->syncPermissions(Permission::all());

        // Assign limited permissions to User
        $limitedPermissions = Permission::whereIn('name', [
            'dynamic_view', // User can only view dynamic pages
        ])->get();

        $userRole->syncPermissions($limitedPermissions);
    }
}
