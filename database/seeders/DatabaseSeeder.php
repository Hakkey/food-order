<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Menu;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@dev.my',
            'password' => bcrypt('asdqwe123'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Staff',
            'email' => 'staff@dev.my',
            'password' => bcrypt('asdqwe123'),
            'role' => 'staff',
        ]);

        $categories = [
            ['name' => 'Appetizers'],
            ['name' => 'Soups'],
            ['name' => 'Salads'],
            ['name' => 'Main Courses'],
            ['name' => 'Desserts'],
            ['name' => 'Beverages'],
            ['name' => 'Specials'],
            ['name' => 'Kids Menu'],
            ['name' => 'Vegetarian'],
            ['name' => 'Vegan'],
            ['name' => 'Gluten-Free'],
            ['name' => 'Seafood'],
            ['name' => 'Poultry'],
            ['name' => 'Meat'],
            ['name' => 'Pasta'],
            ['name' => 'Sides'],
            ['name' => 'Breakfast'],
            ['name' => 'Lunch'],
            ['name' => 'Dinner'],
        ];
        
        foreach ($categories as $category) {
            Category::create($category);
        }

        Menu::factory()->count(30)->create();
    }
}
