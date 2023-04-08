<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\PostService;

class PostController extends Controller
{

    protected $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->service->getAll();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(['user_id' => auth()->user()->id ?? null]);
        $post = $this->service->create($request->except('categories','thumbnail', 'tags'));
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request->merge(['user_id' => auth()->user()->id ?? null]);
        $post = $this->service->update($id, $request->except('categories','thumbnail', 'tags'));
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return $this->service->delete($id);
    }
}
