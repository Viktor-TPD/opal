<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
        
    public function definition(): array
    {

        $prefix = ucfirst(fake()->safeColorName);
        $suffix = ['Beard Oil', 'Schampoo', 'Beard Comb', 'Deodorant', 'Condoms', 'Beard Conditioner', 'Cologne', 'Hair Gel', 'Razors', 'After Shave', 'Soap'];
        $name = $prefix . " " . $suffix[array_rand($suffix)];

        $categoryId = Category::inRandomOrder()->first()?->id;

        return [
            'name' => $name,
            'description' => fake()->paragraph(),
            'price' => fake()->numberBetween(1, 100) - 0.01,
            'created_at' => now(),
            'updated_at' => now(),
            'category_id' => $categoryId,
        ];
    }
}