<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Discount;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    $categoryIds = ProductCategory::pluck('id')->toArray();
    $discountIds = Discount::pluck('id')->toArray();

    return [
        'name' => $this->faker->firstName(),
        'sku' => $this->faker->randomNumber(),
        'content' => $this->faker->sentence(),
        'price' => $this->faker->numberBetween(100,500),
        'stock' => $this->faker->numberBetween(100,500),
        'status' => $this->faker->numberBetween(0,1),
        'category_id' => $this->faker->randomElement($categoryIds),
        'discount_id' => $this->faker->randomElement($discountIds),
        'created_at' => $this->faker->dateTimeBetween(now()->subMonths(6), 'now'),
    ];
}

}
