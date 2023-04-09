<?php

namespace App\Http\Controllers\Api;

use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PostCategoryService;
use App\Http\Requests\PostCategoryStoreRequest;

class PostCategoryController extends Controller
{
    protected $postCategoryService;

    public function __construct(PostCategoryService $postCategoryService)
    {
        $this->postCategoryService  = $postCategoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json($this->postCategoryService->index($request));
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
    public function store(PostCategoryStoreRequest $request)
    {
        return response()->json($this->postCategoryService->create($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return response()->json($this->postCategoryService->find($id));
        } catch (\Exception $e) {
            return $e;
            //return response()->json(['error' => 'An error occurred'], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(PostCategoryStoreRequest $request, string $id)
    {
        try {
            return response()->json($this->postCategoryService->update($request, $id));
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
            return response()->json($this->postCategoryService->delete($id));
        } catch (\Exception $e) {
            return $e;
            //return response()->json(['error' => 'An error occurred'], 500);
        }
    }
}
