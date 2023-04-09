<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductVariantOption;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariantOptionPrice>
 */
class ProductVariantOptionPriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productIds = Product::pluck('id')->toArray();
        $productVariantOptionIds = ProductVariantOption::pluck('id')->toArray();
        return [
            'price' => $this->faker->numberBetween(100,150),
            'product_id' => $this->faker->randomElement($productIds),
            'product_variant_option_id' => $this->faker->randomElement($productVariantOptionIds),
        ];
    }
}
