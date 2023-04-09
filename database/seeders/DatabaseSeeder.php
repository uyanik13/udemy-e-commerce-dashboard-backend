<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\ProductCategory::factory(10)->create();
        \App\Models\Discount::factory(10)->create();
        \App\Models\Product::factory(25)->create();
        \App\Models\User::factory(25)->create();
        \App\Models\UserAddress::factory(10)->create();
        \App\Models\UserPayment::factory(10)->create();
        \App\Models\ShoppingSession::factory(10)->create();
        \App\Models\CartItem::factory(10)->create();
        \App\Models\PaymentDetail::factory(10)->create();
        \App\Models\OrderDetail::factory(10)->create();
        \App\Models\OrderItem::factory(10)->create();
        \App\Models\PostCategory::factory(25)->create();
        \App\Models\PostTag::factory(50)->create();
        \App\Models\Post::factory(50)->create();
        \App\Models\PostHasTag::factory(25)->create();
        \App\Models\PostHasCategory::factory(25)->create();
        \App\Models\ProductVariant::factory(12)->create();
        \App\Models\ProductVariantOption::factory(80)->create();
        \App\Models\ProductVariantOptionInventory::factory(80)->create();
        \App\Models\ProductVariantOptionPrice::factory(80)->create();
        \App\Models\Shipping::factory(5)->create();

    }
}
