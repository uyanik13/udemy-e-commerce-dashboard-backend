<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\BaseService;
use App\Repositories\ProductRepository;

class ProductService extends BaseService
{
   protected $repository;

   public function __construct(ProductRepository $repository)
   {
      $this->repository = $repository;
   }

   public function getAll()
   {
      return $this->repository->all();
   }

   public function find(int $id)
   {
      return $this->repository->find($id);
   }

   public function create(Request $request)
   {
     
      $product = $this->repository->create($request->except('size', 'images', 'shipping_id', 'product_variants'));

      if($request->has('images') && is_array($request->images) && count($request->images)){
         $images = $request->images;
         foreach ($images as $image) {
            $imageData = uploadImage($image, 'product');
            $imageData['product_id'] = $product->id;
            $product->images()->create($imageData);
         }
      }

      $product->size()->create($request->size);
      $product->productShipping()->create(['shipping_id' => $request->shipping_id]);

      $this->createVariants($request->product_variants, $product);
   }

   public function update(int $id, Request $request)
   {
      
   }

   public function delete(int $id)
   {
      return $this->repository->delete($id);
   }

   protected function createVariants(string $productVariants, Product $product)
   {
      $productVariants = json_decode($productVariants, true);

      foreach ($productVariants as $variant) {
         
         if(is_array($variant) && isset($variant['id'])){
           $productVariantOption = $product->product_variant_options()->create([
               'product_variant_id' => $variant['id'],
               'value' => $variant['value']
           ]);
            $product->product_variant_options_invetories()->create([
               'product_variant_option_id' => $productVariantOption->id,
               'stock' => $variant['stock']
           ]);
            $product->product_variant_options_prices()->create([
               'product_variant_option_id' => $productVariantOption->id,
               'price' => $variant['price']
           ]);
         }
      }
   }
}
