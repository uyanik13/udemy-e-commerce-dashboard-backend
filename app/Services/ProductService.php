<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\BaseService;
use App\Repositories\ProductRepository;
use App\Repositories\ProductVariantRepository;

class ProductService extends BaseService
{
   protected $repository;
   protected $productVariantRepository;

   public function __construct(ProductRepository $repository, ProductVariantRepository $productVariantRepository)
   {
      $this->repository = $repository;
      $this->productVariantRepository = $productVariantRepository;
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
      $attributes = $request->except(['size', 'images', 'shipping_id', 'product_variants']);
      $product = $this->repository->create($attributes);
      $this->updateProductAssociations($product, $request);
   }

   public function update(int $id, Request $request)
   {
      $product = $this->repository->find($id);
      $product->fill($request->except(['size', 'images', 'shipping_id', 'product_variants', 'deleted_images', 'deleted_variants']));
      $product->save();
      $this->updateProductAssociations($product, $request);
   }

   public function delete(int $id)
   {
      $product = $this->repository->find($id);
      $this->deleteProductAssociations($product);
      $product->delete();
   }

   protected function updateProductAssociations(Product $product, Request $request)
   {
      $this->manageProductImages($product, $request);
      $product->size()->updateOrCreate([], $request->size);
      $product->productShipping()->updateOrCreate([], ['shipping_id' => $request->shipping_id]);
      
      if ($request->has('deleted_variants') && is_array($request->deleted_variants) && count($request->deleted_variants)) {
         $this->deleteVariants($request->deleted_variants, $product);
      }
      if ($request->has('product_variants') && is_array($request->product_variants) && count($request->product_variants)) {
         $this->createVariants($request->product_variants, $product);
      }
   }

   protected function manageProductImages(Product $product, Request $request)
   {
      if ($request->has('deleted_images') && is_array($request->deleted_images) && count($request->deleted_images)) {
         foreach ($request->deleted_images as $image) {
            $product->images()->findOrFail($image['id'])->delete();
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
   }

   protected function deleteProductAssociations(Product $product)
   {
      $product->images()->delete();
      $product->productShipping()->delete();
      $product->size()->delete();
      //$this->deleteVariants($product);
   }

   protected function createVariants(array $productVariants, Product $product)
   {
      foreach ($productVariants as $variant) {
         if (is_array($variant) && isset($variant['id'])) {
            $productVariant = $this->productVariantRepository->find($variant['id']);
            if ($productVariant) {
               $productVariantOption = $product->productVariantOptions()->create([
                  'product_variant_id' => $productVariant->id,
                  'value' => $variant['value']
               ]);
               $product->productVariantOptionInventories()->create([
                  'product_variant_option_id' => $productVariantOption->id,
                  'stock' => $variant['stock']
               ]);
               $product->productVariantOptionPrices()->create([
                  'product_variant_option_id' => $productVariantOption->id,
                  'price' => $variant['price']
               ]);
            }
         }
      }
   }

   protected function deleteVariants(array $deleteVariants, Product $product)
   {
      if (is_array($deleteVariants) && count($deleteVariants)) {
         foreach ($deleteVariants as $variant) {
            if (isset($variant['id'])) {
               // Find and delete the related product_variant_options_inventories
               $product->productVariantOptionInventories()->where('stock', $variant['stock'])->delete();

               // Find and delete the related product_variant_options_prices
               $product->productVariantOptionPrices()->where('price', $variant['price'])->delete();

               // Find and delete the related product_variant_options
               $product->productVariantOptions()->where('id', $variant['id'])->delete();
           }
         }
      }
     
   }
}
