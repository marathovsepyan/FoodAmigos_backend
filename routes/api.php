<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\UserController;

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

Route::get('products', [ProductController::class, 'index']);

Route::middleware('auth:sanctum')->group(function(){
    Route::prefix('baskets')->group(function(){
        Route::get('', [BasketController::class, 'index']);
        Route::post('', [BasketController::class, 'store']);
        Route::patch('{basketId}', [BasketController::class, 'update']);
        Route::delete('{basketId}', [BasketController::class, 'delete']);
    });
});




Route::post('sign-up', [UserController::class, 'signUp']);
Route::post('tokens', [UserController::class, 'issueToken']);

