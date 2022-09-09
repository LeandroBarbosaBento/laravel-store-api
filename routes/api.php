<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\OrderController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\LoginController;
use \App\Http\Controllers\RegisterController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('categories', CategoryController::class)
        ->only('store', 'update')
        ->middleware('auth:sanctum');

Route::apiResource('categories', CategoryController::class)
        ->only('index');

Route::apiResource('products', ProductController::class)
        ->only('store', 'update', 'destroy')
        ->middleware('auth:sanctum');

Route::apiResource('products', ProductController::class)
        ->only('index');

Route::apiResource('orders', OrderController::class)
        ->middleware('auth:sanctum');

Route::apiResource('users', UserController::class)
        ->only('store', 'update', 'destroy')
        ->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
    Route::post('login', [
        LoginController::class,
        'login']
    );

    Route::post('logout', [
        LoginController::class,
        'logout'
    ])->middleware('auth:sanctum');

    Route::post('register', [
        RegisterController::class,
        'register'
    ]);
});
