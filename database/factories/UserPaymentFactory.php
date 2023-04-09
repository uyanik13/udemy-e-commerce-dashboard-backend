<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserPayment>
 */
class UserPaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'user_id' => function () {
            return User::all()->random()->id;
        },
        'payment_type' => $this->faker->randomElement(['credit', 'debit', 'cash']),
        'provider' => $this->faker->numberBetween(1000, 9999),
        'account_no' => $this->faker->creditCardNumber(),
        'expiry' => $this->faker->creditCardExpirationDate(),
    ];
}

}
