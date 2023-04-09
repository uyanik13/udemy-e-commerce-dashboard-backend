<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostTag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostHasTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $posts = Post::pluck('id')->toArray();
        $postTags = PostTag::pluck('id')->toArray();

        return [
            'post_id' => $this->faker->randomElement($posts),
            'post_tag_id' => $this->faker->randomElement($postTags),
        ];
    }
}
