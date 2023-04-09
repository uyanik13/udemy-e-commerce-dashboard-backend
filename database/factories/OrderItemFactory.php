<?php

namespace Database\Factories;

use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $orderDetailIds = OrderDetail::pluck('id')->toArray();
        $productIds = Product::pluck('id')->toArray();

        return [
            'order_id' => $this->faker->randomElement($orderDetailIds),
            'product_id' => $this->faker->randomElement($productIds),
            'created_at' => $this->faker->dateTimeBetween(now()->subMonths(6), 'now')
        ];
    }

}
