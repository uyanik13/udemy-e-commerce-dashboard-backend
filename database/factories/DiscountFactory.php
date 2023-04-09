<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discount>
 */
class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'desc' => $this->faker->sentence(),
            'discount_percent' => $this->faker->randomNumber(2) . "0.07",
            'status' => $this->faker->numberBetween(0,1),
        ];
    }
}
