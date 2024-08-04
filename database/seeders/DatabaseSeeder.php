<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
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

        Category::create([
            'name' => 'Web Design'
        ]);

        User::create([
            'name' => 'John',
            'email' => 'john@gmail.com',
            'password' => bcrypt('password')
        ]);
    }
}
