<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Services\BaseService;
use App\Repositories\PostRepository;

class PostService extends BaseService
{
   protected $repository;

   public function __construct(PostRepository $repository)
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
      $createdPost = $this->repository->create($request->except('categories', 'tags', 'thumbnail'));

      if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
         $image = uploadImage($request->thumbnail, 'post');
         if (is_array($image) && isset($image['image_url'])) {
            $createdPost->thumbnail = $image['image_url'];
            $createdPost->save();
         }
      }

      if ($request->has('categories')) {
         $createdPost->categories()->sync($request->categories);
      }

      if ($request->has('tags')) {
         $createdPost->tags()->sync($request->tags);
      }

      return $createdPost;
   }

   public function update(int $id, Request $request)
   {
      $post = $this->repository->find($id);
      $post->fill($request->except('categories', 'tags', 'thumbnail'));

      if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
         $image = uploadImage($request->thumbnail, 'post');
         if (is_array($image) && isset($image['image_url'])) {
            $post->thumbnail = $image['image_url'];
         }
      }

      if ($request->has('categories')) {
         $post->categories()->sync($request->categories);
      }

      if ($request->has('tags')) {
         $post->tags()->sync($request->tags);
      }

      $post->save();

      return $post;
   }

   public function delete(int $id)
   {
      return $this->repository->delete($id);
   }
}
