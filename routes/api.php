<?php

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

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index']);
    Route::post('/product/create', [\App\Http\Controllers\ProductController::class, 'insert']);
    Route::put('/product/{product}/update', [\App\Http\Controllers\ProductController::class, 'update']);
    Route::delete('/product/{product}/delete', [\App\Http\Controllers\ProductController::class, 'delete']);
});