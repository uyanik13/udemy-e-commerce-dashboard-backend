<?php

namespace App\Http\Controllers\Api;

use App\Models\ProductShipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductShipping::all();
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductShipping $productShipping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductShipping $productShipping)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductShipping $productShipping)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductShipping $productShipping)
    {
        //
    }
}
