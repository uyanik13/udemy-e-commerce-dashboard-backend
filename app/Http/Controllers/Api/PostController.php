<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Controllers\ApiController;
use App\Http\Requests\PostStoreRequest;


class PostController extends ApiController
{

    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService  = $postService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json($this->postService->index($request));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request)
    {
        try {
            return response()->json($this->postService->create($request));
        } catch (\Exception $e) {
            return $e;
            //return response()->json(['error' => 'An error occurred'], 500);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return response()->json($this->postService->find($id));
        } catch (\Exception $e) {
            return $e;
            //return response()->json(['error' => 'An error occurred'], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(PostStoreRequest $request, string $id)
    {
        try {
            return response()->json($this->postService->update($request, $id));
        } catch (\Exception $e) {
            return $e;
            //return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            return response()->json($this->postService->delete($id));
        } catch (\Exception $e) {
            return $e;
            //return response()->json(['error' => 'An error occurred'], 500);
        }
    }
}
