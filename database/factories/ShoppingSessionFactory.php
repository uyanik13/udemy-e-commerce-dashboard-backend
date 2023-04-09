<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShoppingSession>
 */
class ShoppingSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    $userIds = User::pluck('id')->toArray();

    return [
        'user_id' => $this->faker->randomElement($userIds),
        'total' => $this->faker->numberBetween(200,5000),
    ];
}
}
