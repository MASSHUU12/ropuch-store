<?php

use App\Http\Controllers\SetupController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/setup', [SetupController::class, '__invoke']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', [UserController::class, 'show_current']);
    Route::put('/user', [UserController::class, 'update_current']);
    Route::delete('/user', [UserController::class, 'destroy_current']);

    Route::get('/cart', [ShoppingCartController::class, 'index']);
    Route::post('/cart', [ShoppingCartController::class, 'store']);
    Route::put('/cart/{id}', [ShoppingCartController::class, 'update']);
    Route::delete('/cart', [ShoppingCartController::class, 'destroy_all']);
    Route::delete('/cart/{id}', [ShoppingCartController::class, 'destroy']);

    Route::post('/order', [ShopController::class, 'place_order']);
    Route::get('/user/orders', [OrderController::class, 'index_user']);
    Route::delete('/order/{id}', [ShopController::class, 'cancel_order']);
    Route::get('/user/order/{id}', [OrderController::class, 'show_user']);

    // Routes for admins and managers
    Route::group(['middleware' => ['abilities:admin,manager']], function () {
        Route::post('/product', [ProductController::class, 'store']);
        Route::put('/product/{id}', [ProductController::class, 'update']);
        Route::delete('/product/{id}', [ProductController::class, 'destroy']);

        Route::post('/employee', [EmployeeController::class, 'store']);
        Route::get('/employees', [EmployeeController::class, 'index']);
        Route::get('/employee/{id}', [EmployeeController::class, 'show']);
        Route::put('/employee/{id}', [EmployeeController::class, 'update']);
        Route::delete('/employee/{id}', [EmployeeController::class, 'destroy']);
    });

    // Routes for all employees
    Route::group(['middleware' => ['abilities:admin,manager,employee']], function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/user/{id}', [UserController::class, 'show']);
        Route::put('/user/{id}', [UserController::class, 'update']);
        Route::delete('/user/{id}', [UserController::class, 'destroy']);

        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/order/{id}', [OrderController::class, 'show']);
    });
});
