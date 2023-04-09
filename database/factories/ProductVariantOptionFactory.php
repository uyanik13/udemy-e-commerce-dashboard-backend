<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariantOption>
 */
class ProductVariantOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    $variantIds = ProductVariant::pluck('id')->toArray();
    $productIds = Product::pluck('id')->toArray();

    $variants = [
        'Size' => ['Small', 'Medium', 'Large'],
        'Color' => ['Red', 'Green', 'Blue'],
        'Material' => ['Leather', 'Fabric', 'Metal'],
        'Style' => ['Modern', 'Rustic', 'Industrial'],
        'Finish' => ['Matte', 'Glossy', 'Brushed'],
        'Shape' => ['Square', 'Round', 'Oval'],
        'Weight' => ['Light', 'Medium', 'Heavy'],
        'Length' => ['Short', 'Medium', 'Long'],
        'Width' => ['Narrow', 'Standard', 'Wide'],
        'Height' => ['Low', 'Medium', 'Tall'],
        'Texture' => ['Smooth', 'Rough', 'Patterned'],
        'Pattern' => ['Floral', 'Geometric', 'Abstract'],
    ];

    // Select a random variant ID and get the corresponding variant value
    $randomVariantId = $this->faker->randomElement($variantIds);
    $variant = ProductVariant::find($randomVariantId);

    return [
        'product_variant_id' => $randomVariantId,
        'product_id' => $this->faker->randomElement($productIds),
        'value' => $variant->value ?? 'Square',
    ];
}
}

