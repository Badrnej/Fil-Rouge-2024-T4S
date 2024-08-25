<?php
// routes/api.php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\DeliveryServiceController;
use App\Http\Controllers\DeliveryController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::group(['middleware' => ['api', 'auth:api']], function () {
    // User routes
    Route::apiResource('users', UserController::class);

    // Order routes
    Route::apiResource('orders', OrderController::class);

    // Package routes
    Route::apiResource('packages', PackageController::class);

    // Inventory routes
    Route::apiResource('inventory', InventoryController::class);

    // Delivery Service routes
    Route::apiResource('delivery-services', DeliveryServiceController::class);

    // Delivery routes
    Route::apiResource('deliveries', DeliveryController::class);
});
