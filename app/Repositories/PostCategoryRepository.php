<?php

namespace App\Repositories;

use App\Models\PostCategory;

class PostCategoryRepository extends BaseRepository
{
    public function __construct(PostCategory $model)
    {
        parent::__construct($model);
    }
}