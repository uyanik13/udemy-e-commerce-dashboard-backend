<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $variants = ['Size', 'Color', 'Material', 'Style', 'Finish', 'Shape', 'Weight', 'Length', 'Width', 'Height', 'Texture', 'Pattern'];

        return [
            'name' => $this->faker->randomElement($variants),
        ];
    }
}
