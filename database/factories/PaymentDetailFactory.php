<?php

namespace Database\Factories;

use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentDetail>
 */
class PaymentDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' =>$this->faker->numberBetween(20, 500),
            'amount' => $this->faker->numberBetween(500, 5000),
            'provider' => $this->faker->company(),
            'status' => $this->faker->randomElement(['pending', 'processing', 'shipped', 'delivered']),
            'created_at' => $this->faker->dateTimeBetween(now()->subMonths(6), 'now'),
        ];
    }
}
