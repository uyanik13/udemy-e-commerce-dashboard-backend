<?php

namespace App\Http\Controllers\Api;

use App\Models\Discount;
use Illuminate\Http\Request;
use App\Services\DiscountService;
use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountStoreRequest;

class DiscountController extends Controller
{
    protected $discountService;
    public function __construct(DiscountService $discountService)
    {
        $this->discountService = $discountService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json($this->discountService->getAll($request));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(DiscountStoreRequest $request)
    {
        try {
            return response()->json($this->discountService->create($request));
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
            return response()->json($this->discountService->find($id));
        } catch (\Exception $e) {
            return $e;
            //return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            return response()->json($this->discountService->update($request, $id));
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
            return response()->json($this->discountService->delete($id));
        } catch (\Exception $e) {
            return $e;
            //return response()->json(['error' => 'An error occurred'], 500);
        }
    }
}

