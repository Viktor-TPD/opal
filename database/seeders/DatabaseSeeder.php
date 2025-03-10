<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        //ADMIN
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@123.com',
            'password' => 123123123,
            'role' => 'admin',
        ]);

        //TEST USER
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 123123123,
            'role' => 'employee',
        ]);

        User::factory(8)->create();
        Category::factory(10)->create();
        Product::factory(100)->create();
    }
}
