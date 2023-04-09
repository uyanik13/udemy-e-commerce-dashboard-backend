<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostHasCategory>
 */
class PostHasCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $posts = Post::pluck('id')->toArray();
        $postCategories= PostCategory::pluck('id')->toArray();

        return [
            'post_category_id' => $this->faker->randomElement($postCategories),
            'post_id' => $this->faker->randomElement($posts),
        ];
    }
}
