<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'id' => 2,
                'name' => 'Health & Fitness',
                'slug' => 'health-fitness',
                'image' => null,
                'status' => 0,
                'description' => 'Tips and articles about health and fitness',
                'created_at' => '2025-09-10 17:45:54',
                'updated_at' => '2025-09-12 16:54:07',
            ],
            [
                'id' => 3,
                'name' => 'Travel',
                'slug' => 'travel',
                'image' => null,
                'status' => 1,
                'description' => 'Travel guides, tips, and experiences',
                'created_at' => '2025-09-10 17:45:54',
                'updated_at' => '2025-09-10 17:45:54',
            ],
            [
                'id' => 4,
                'name' => 'Food & Recipes',
                'slug' => 'food-recipes',
                'image' => null,
                'status' => 1,
                'description' => 'Delicious recipes and food tips',
                'created_at' => '2025-09-10 17:45:54',
                'updated_at' => '2025-09-10 17:45:54',
            ],
            [
                'id' => 5,
                'name' => 'Business',
                'slug' => 'business',
                'image' => 'storage/uploads/categories/SzWwXODXgcSJzb6n94GPqHvG72XWVgKihcxSMaJ8.png',
                'status' => 0,
                'description' => 'Business news and articles',
                'created_at' => '2025-09-10 17:45:54',
                'updated_at' => '2025-09-13 14:27:41',
            ],
            [
                'id' => 6,
                'name' => 'Education',
                'slug' => 'education',
                'image' => null,
                'status' => 1,
                'description' => 'Educational resources and guides',
                'created_at' => '2025-09-10 17:45:54',
                'updated_at' => '2025-09-10 17:45:54',
            ],
            [
                'id' => 7,
                'name' => 'Sports',
                'slug' => 'sports',
                'image' => null,
                'status' => 1,
                'description' => 'Latest sports news and events',
                'created_at' => '2025-09-10 17:45:54',
                'updated_at' => '2025-09-10 17:45:54',
            ],
            [
                'id' => 8,
                'name' => 'Entertainment',
                'slug' => 'entertainment',
                'image' => null,
                'status' => 1,
                'description' => 'Movies, music, and entertainment news',
                'created_at' => '2025-09-10 17:45:54',
                'updated_at' => '2025-09-10 17:45:54',
            ],
            [
                'id' => 9,
                'name' => 'Fashion',
                'slug' => 'fashion',
                'image' => null,
                'status' => 1,
                'description' => 'Fashion tips, trends, and guides',
                'created_at' => '2025-09-10 17:45:54',
                'updated_at' => '2025-09-10 17:45:54',
            ],
            [
                'id' => 10,
                'name' => 'Lifestyle',
                'slug' => 'lifestyle',
                'image' => null,
                'status' => 1,
                'description' => 'Lifestyle articles and tips',
                'created_at' => '2025-09-10 17:45:54',
                'updated_at' => '2025-09-10 17:45:54',
            ],
            [
                'id' => 12,
                'name' => 'Sales',
                'slug' => 'sale',
                'image' => null,
                'status' => 1,
                'description' => null,
                'created_at' => '2025-09-13 12:22:32',
                'updated_at' => '2025-09-13 12:22:32',
            ],
            [
                'id' => 13,
                'name' => 'TechSite',
                'slug' => 'tech',
                'image' => null,
                'status' => 1,
                'description' => null,
                'created_at' => '2025-09-13 13:28:41',
                'updated_at' => '2025-09-13 14:28:32',
            ],
        ]);
    }
}
