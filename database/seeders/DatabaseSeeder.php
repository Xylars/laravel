<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
            $this->call(CategorySeeder::class);

        // User::factory()
        //     ->count(10)
        //     ->has(Profile::factory())       // one profile per user
        //     ->has(Post::factory()->count(3)) // 3 posts per user
        //     ->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
