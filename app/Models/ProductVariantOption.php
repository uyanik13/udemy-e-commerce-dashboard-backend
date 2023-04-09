<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantOption extends Model
{
    use HasFactory;
    protected  $guarded = [];
    protected  $with = ['product_variant'];

    public function product_variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id', 'id');
    }
}
