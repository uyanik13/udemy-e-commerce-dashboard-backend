<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantOptionInventory extends Model
{
    use HasFactory;
    protected  $guarded = [];
    protected  $with = ['product_variant_option'];

    public function product_variant_option()
    {
        return $this->belongsTo(ProductVariantOption::class, 'product_variant_option_id');
    }
}
