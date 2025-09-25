<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Schema::disableForeignKeyConstraints();

        $categories = [
            [
                'name' => 'Technology',
                'description' => 'All about the latest gadgets, programming, and innovations.'
            ],
            [
                'name' => 'Sports',
                'description' => 'News and articles about different kinds of sports.'
            ],
            [
                'name' => 'Travel',
                'description' => 'Tips, guides, and experiences from around the world.'
            ],
            [
                'name' => 'Health',
                'description' => 'Articles on fitness, diet, and well-being.'
            ],
            [
                'name' => 'Education',
                'description' => 'Learning resources, study tips, and academic news.'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
        Schema::enableForeignKeyConstraints();

    }
}
