<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['size', 'images'];

    protected $appends = ['product_variants', 'shipping_id'];

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function productVariantOptions()
    {
        return $this->hasMany(ProductVariantOption::class,'product_id', 'id');
    }

    public function productVariantOptionInventories()
    {
        return $this->hasMany(ProductVariantOptionInventory::class,'product_id', 'id');
    }

    public function productVariantOptionPrices()
    {
        return $this->hasMany(ProductVariantOptionPrice::class,'product_id','id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id','id');
    }
    
    public function size()
    {
        return $this->hasOne(ProductSize::class)->withDefault([
            "weight_type" => null,
            "weight" => null,
            "width" => null,
            "height" => null,
            "length" => null,
        ]);
    }

    // Define the relationship
    public function productShipping()
    {
        return $this->hasOne(ProductShipping::class, 'product_id', 'id');
    }
    
    // Create an accessor for the shipping_id attribute
    public function getShippingIdAttribute()
    {
        return optional($this->productShipping)->shipping_id;
    }

    public function getProductVariantsAttribute($loadProductVariants = false)
    {
        if (!$loadProductVariants) {
            $this->load('productVariantOptions');
        }
        // Load the required relationships if not loaded
        if (!$this->relationLoaded('productVariantOptionInventories')) {
            $this->load('productVariantOptionInventories');
        }

        if (!$this->relationLoaded('productVariantOptionPrices')) {
            $this->load('productVariantOptionPrices');
        }

        $productVariants = [];

        foreach ($this->productVariantOptionInventories as $index =>  $pvoi) {
            $productVariants[$index]['id'] = $pvoi->id;
            $productVariants[$index]['stock'] = $pvoi->stock;
        }

        foreach ($this->productVariantOptionPrices as $index =>  $pvop) {
            $productVariants[$index]['id'] = $pvop->id;
            $productVariants[$index]['price'] = $pvop->price;
            $productVariants[$index]['value'] = $pvop->product_variant_option['value'];
        }

        return $productVariants;
    }

}
