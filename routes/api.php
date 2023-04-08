<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostTagController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->middleware('auth:sanctum')->group(function(){
    Route::apiResource('post', PostController::class);
    Route::apiResource('post-category', PostCategoryController::class);
    Route::apiResource('post-tag', PostTagController::class);
});



Route::post('auth/register', [AuthController::class, 'register'])->name('api.user.register');
Route::post('auth/login', [AuthController::class, 'login'])->name('api.user.login');