<?php

namespace App\Repositories;

use App\Models\PostTag;
use Illuminate\Database\Eloquent\Model;


class PostTagRepository extends BaseRepository
{
    public function __construct(PostTag $model)
    {
        parent::__construct($model);
    }


}