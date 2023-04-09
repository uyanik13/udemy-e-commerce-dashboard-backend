<?php

namespace App\Models;

use App\Models\PostTag;
use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['category'];

    //Pivot Table baglantisi  - yani ara tablo ile baglanti - post_has_categories
    public function categories()
    {
        return $this->belongsToMany(PostCategory::class, 'post_has_categories', 'post_id', 'post_category_id');
    }

    //Pivot Table baglantisi  - yani ara tablo ile baglanti -post_has_tags
    public function tags()
    {
        return $this->belongsToMany(PostTag::class, 'post_has_tags', 'post_id', 'post_tag_id');
    }

    public function category()
    {
        return $this->hasOne(PostCategory::class, 'id', 'post_category_id');
    }

}
