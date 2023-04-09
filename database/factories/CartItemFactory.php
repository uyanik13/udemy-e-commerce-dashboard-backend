<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ShoppingSession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $shoppingSessionIds = ShoppingSession::pluck('id')->toArray();
        $productIds = Product::pluck('id')->toArray();

        return [
            'session_id' => $this->faker->randomElement($shoppingSessionIds),
            'product_id' => $this->faker->randomElement($productIds),
            'stock' => $this->faker->randomNumber(2),
        ];
    }

}
