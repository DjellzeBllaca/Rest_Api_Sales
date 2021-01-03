<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', [ProductController::class,'index']);
Route::post('/products', [ProductController::class,'store']);
Route::put('/products/{id}', [ProductController::class,'update']);
Route::delete('/products/{id}', [ProductController::class,'destroy']);

Route::get('/stock', [StockController::class,'index']);
Route::post('/stock', [StockController::class,'store']);
Route::put('/stock/{id}', [StockController::class,'update']);
Route::delete('/stock/{id}', [StockController::class,'destroy']);

Route::get('/sale', [SaleController::class,'index']);
Route::post('/sale', [SaleController::class,'store']);
Route::put('/sale/{id}', [SaleController::class,'update']);
Route::delete('/sale/{id}', [SaleController::class,'destroy']);

