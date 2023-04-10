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
      $product = $this->repository->find($id);
      $product = $product->toArray();
      return $this->deleteApiAttributes($product);
   }

   public function create(Request $request)
   {

      $product = $this->repository->create($request->except('size', 'images', 'shipping_id', 'product_variants'));

      if ($request->has('images') && is_array($request->images) && count($request->images)) {
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
      $product = $this->repository->find($id);
      $product->fill($request->except('size', 'images', 'shipping_id', 'product_variants', 'deleted_images'));
      $product->save();

      $deletedImages = json_decode($request->deleted_images, true);

      if (is_array($deletedImages) && count($deletedImages) && isset($deletedImages[0]['id'])) {
         foreach ($deletedImages as $image) {
            $product->images()->delete($image);
         }
      }

      if ($request->has('images') && is_array($request->images) && count($request->images)) {
         $images = $request->images;
         foreach ($images as $image) {
            $imageData = uploadImage($image, 'product');
            $imageData['product_id'] = $product->id;
            $product->images()->create($imageData);
         }
      }

      $product->size()->update($request->size);
      $product->productShipping()->update(['shipping_id' => $request->shipping_id]);

       
       $this->deleteVariants($product);
       $this->createVariants($request->product_variants, $product);
   }

   public function delete(int $id)
   {
      $product = $this->repository->find($id);
      
      if(count($product->images()->get())){
         $product->images()->delete();
      }
      if(count($product->productShipping()->get())){
            $product->productShipping()->delete();
      }
      if(count($product->size()->get())){
            $product->size()->delete();
      }

      $this->deleteVariants($product);

      $product->delete();
   }

   protected function createVariants(string $productVariants, Product $product)
   {
      $productVariants = json_decode($productVariants, true);

      foreach ($productVariants as $variant) {

         if (is_array($variant) && isset($variant['id'])) {
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

   protected function deleteVariants($product)
   {

       $pvois = $product->product_variant_options_invetories()->get();
       $pvops = $product->product_variant_options_prices()->get();
       $pvos = $product->product_variant_options()->get();


       if (count($pvois)) {
           $product->product_variant_options_invetories()->delete();
       }

       // Check if product_variant_options_prices is not an array and delete if true
       if (count($pvops)) {
           $product->product_variant_options_prices()->delete();
       }

       // Check if product_variant_options is not an array and delete if true
       if (count($pvos)) {
           $product->product_variant_options()->delete();
       }

   }

   protected function deleteApiAttributes(array $product)
   {
      unset($product['product_variant_options_invetories']);
      unset($product['product_variant_options_prices']);
      unset($product['updated_at']);
      unset($product['created_at']);
      unset($product['discount']);
      unset($product['product_category']);
      unset($product['product_shipping']);
      return $product;
   }
}
