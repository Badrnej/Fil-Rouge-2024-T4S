<?php

use App\Http\Controllers\AuthController;

use App\Http\Controllers\ProductController;



Route::get('/v', function () {
    return response()->json(['message' => 'hello velo']);
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::resource('products', ProductController::class);
Route::middleware(['auth.jwt'])->group(function () {
    Route::resource('products', ProductController::class);
});


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware(['auth.jwt'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'getUser']);
});
