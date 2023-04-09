<?php

namespace Database\Factories;

use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck('id')->toArray();
        $postCategories = PostCategory::pluck('id')->toArray();

        return [
            'user_id' => $this->faker->randomElement($userIds),
            'post_category_id' => $this->faker->randomElement($postCategories),
            'title' => $this->faker->word(),
            'content' => $this->faker->sentence(),
            'slug' => Str::slug($this->faker->word()),
            'seo_title' => $this->faker->sentence(),
            'seo_description' => $this->faker->sentence(),
            'focus_keyword' => $this->faker->word(),
            'status' => $this->faker->randomElement([1,0]),
            'thumbnail' => $this->faker->image(),
        ];
    }
}
