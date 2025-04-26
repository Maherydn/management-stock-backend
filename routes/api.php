<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SalesController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function (Request $request) {
    return 'J\'ai faim';
});

Route::post('user', [UserController::class, 'store']);
Route::get('user', [UserController::class, 'index']);
Route::put('user/{id}', [UserController::class, 'update']);
Route::get('user/{id}', [UserController::class, 'show']);

Route::post('login', [AuthController::class, 'login']);

Route::post('product', [ProductController::class, 'store']);
Route::get('product', [ProductController::class, 'index']);
Route::put('product/{product}', [ProductController::class, 'update']);
Route::get('product/{product}', [ProductController::class, 'show']);

Route::post('category', [CategoryController::class, 'store']);
Route::get('category', [CategoryController::class, 'index']);
Route::put('category/{category}', [CategoryController::class, 'update']);
Route::get('category/{category}', [CategoryController::class, 'show']);

Route::post('sale', [SalesController::class, 'store']);
Route::put('sale/{sale}', [SalesController::class, 'update']);
Route::get('sale', [SalesController::class, 'index']);
Route::get('sale/{sale}', [SalesController::class, 'show']);

Route::post('order', [OrderController::class, 'store']);
Route::put('order/{order}', [OrderController::class, 'update']);
Route::get('order', [OrderController::class, 'index']);
Route::get('order/{order}', [OrderController::class, 'show']);
