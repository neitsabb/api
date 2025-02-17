<?php

use App\Http\Controllers\IngredientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('/products', ProductController::class);

Route::apiResource('/ingredients', IngredientController::class);

Route::apiResource('/orders', OrderController::class);
