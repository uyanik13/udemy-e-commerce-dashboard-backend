<?php

namespace App\Http\Controllers\Api;

use App\Models\PostTag;
use Illuminate\Http\Request;
use App\Services\PostTagService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostTagStoreRequest;

class PostTagController extends Controller
{
    protected $postTagService;

    public function __construct(PostTagService $postTagService)
    {
        $this->postTagService = $postTagService;

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json($this->postTagService->index($request));
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
    public function store(PostTagStoreRequest $request)
    {
        try {
            return response()->json($this->postTagService->create($request));
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
            return response()->json($this->postTagService->find($id));
        } catch (\Exception $e) {
            return $e;

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostTagStoreRequest $postCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostTagStoreRequest $request, $id)
    {
        try {
            return response()->json($this->postTagService->update($request, $id));
        } catch (\Exception $e) {
            return $e;

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {

        try {
            return response()->json($this->postTagService->delete($id));
        } catch (\Exception $e) {
            return $e;

        }
    }
}
