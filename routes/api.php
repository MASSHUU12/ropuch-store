<?php

use App\Http\Controllers\AuthController;
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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Admin test routes
Route::group(['middleware' => ['debug', 'auth:sanctum', 'abilities:admin']], function () {
    Route::get('/admin', function () {
        return response()->json(['message' => 'Admin route']);
    });
});

// Employee test routes
Route::group(['middleware' => ['debug', 'auth:sanctum', 'abilities:employee']], function () {
    Route::get('/employee', function () {
        return response()->json(['message' => 'Employee route']);
    });
});

// User test routes
Route::group(['middleware' => ['debug', 'auth:sanctum', 'abilities:user']], function () {
    Route::get('/user', function () {
        return response()->json(['message' => 'User route']);
    });
});
