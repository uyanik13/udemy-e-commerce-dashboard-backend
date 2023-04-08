<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(PostCategory::class, 'post_has_categories', 'post_id', 'post_category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(PostTag::class, 'post_has_tags', 'post_id', 'post_tag_id');
    }

}
