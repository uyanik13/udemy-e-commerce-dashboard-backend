<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAddress>
 */
class UserAddressFactory extends Factory
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
        'address_line_1' => $this->faker->streetAddress(),
        'address_line_2' =>  $this->faker->streetAddress(),
        'city' => $this->faker->city(),
        'zip_code' => $this->faker->postcode(),
        'country' => $this->faker->country(),
        'phone' => $this->faker->phoneNumber(),
    ];
}

}
