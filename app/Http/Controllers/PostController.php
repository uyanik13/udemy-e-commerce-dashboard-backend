<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $post = Post::create([
            'user_id'=> $user->id?? null,
            'post_category_id'=> $request->post_category_id,
            'title'=>   $request->title,
            'content'=>  $request->content,
            'slug'=> Str::slug( $request->title),
            'seo_title'=> $request->seo_title,
            'seo_description'=> $request->seo_description,
            'focus_keyword'=> $request->focus_keyword,
            'status'=> $request->status,
            'thumbnail'=> $request->thumbnail,
            'thumbnail_alt_text'=> $request->thumbnail_alt_text,
        ]);

        return $post;
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if($post){
            $post->fill($request->except('categories','thumbnail', 'tags'));
            $post->save();
        }
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if($post){
            return $post->delete();
        }
    }
}
