<?php

namespace App\Services;

use App\Models\PostCategory;
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

      if($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()){
         $image = uploadImage($request->thumbnail, 'post');
         if(is_array($image) && isset($image['image_url'])){
            $createdPost->thumbnail = $image['image_url'];
            $createdPost->save();
         }
      }

      if($request->has('categories')){
         $createdPost->categories()->sync($request->categories);
      }

      if($request->has('tags')){
         $createdPost->tags()->sync($request->tags);
      }

       return $createdPost;
    }
    
    public function update(int $id, Request $request)
    {
       return $this->repository->update($id, $request->toArray());
    }

    public function delete(int $id)
    {
       return $this->repository->delete($id);
    }

}