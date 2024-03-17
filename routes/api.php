<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BasketController;

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

Route::get('baskets', [BasketController::class, 'index']);
Route::post('baskets', [BasketController::class, 'store']);
Route::patch('baskets/{basketId}', [BasketController::class, 'update']);
Route::delete('baskets/{basketId}', [BasketController::class, 'delete']);
