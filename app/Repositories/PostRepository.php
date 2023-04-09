<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class PostRepository extends BaseRepository
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function find(int $id)
    {
        try {
            $post =  $this->model
                ->where('id', $id)
                ->with('tags')
                ->with('categories')
                ->first();
            if (isset($post->categories)) {
                $post->categories->transform(function ($cat) {
                    return $cat->id;
                });
            }
            if (isset($post->tags)) {
                $post->tags->transform(function ($tag) {
                    return $tag->id;
                });
            }

            return $post;
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Post not found'], 404);
        }
    }
}
