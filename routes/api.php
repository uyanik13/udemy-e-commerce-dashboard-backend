<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\PostTagController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\DiscountController;
use App\Http\Controllers\Api\ShippingController;
use App\Http\Controllers\Api\PostCategoryController;
use App\Http\Controllers\Api\ProductVariantController;
use App\Http\Controllers\Api\ProductCategoryController;
use App\Http\Controllers\Api\ProductVariantOptionController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('auth')->middleware('auth:sanctum')->group(function(){
    Route::apiResource('post', PostController::class);
    Route::apiResource('post-category', PostCategoryController::class);
    Route::apiResource('post-tag', PostTagController::class);
    Route::apiResource('product', ProductController::class);
    Route::apiResource('product-category', ProductCategoryController::class);
    Route::apiResource('product-variant', ProductVariantController::class);
    Route::apiResource('product-variant-option', ProductVariantOptionController::class);
    Route::apiResource('discount', DiscountController::class);
    Route::apiResource('shipping', ShippingController::class);
});



Route::post('auth/register', [AuthController::class, 'register'])->name('api.user.register');
Route::post('auth/login', [AuthController::class, 'login'])->name('api.user.login');