<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use App\Services\ProductCategoryService;
use App\Http\Requests\ProductCategoryStoreRequest;



class ProductCategoryController extends Controller
{
    protected $productCategoryService;

    public function __construct(ProductCategoryService $productCategoryService)
    {
        $this->productCategoryService  = $productCategoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json($this->productCategoryService->getAll($request));
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
    public function store(ProductCategoryStoreRequest $request)
    {
        return response()->json($this->productCategoryService->create($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return response()->json($this->productCategoryService->find($id));
        } catch (\Exception $e) {
            return $e;
            //return response()->json(['error' => 'An error occurred'], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ProductCategoryStoreRequest $request, string $id)
    {
        try {
            return response()->json($this->productCategoryService->update($request, $id));
        } catch (\Exception $e) {
            return $e;
            //return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {

        try {
            return response()->json($this->productCategoryService->delete($productCategory));
        } catch (\Exception $e) {
            return $e;

        }
    }
}
