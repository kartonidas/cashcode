<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->text(50),
            'metal' => fake()->randomElement(array_keys(Product::allowedMetals())),
            'weight' => fake()->randomFloat(2, 100, 2000),
            'change' => fake()->randomFloat(2, 1, 50),
        ];
    }
}
