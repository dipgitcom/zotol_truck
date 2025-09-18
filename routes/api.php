<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Api\UserController;

// API login
Route::post('login', [AuthController::class, 'apiLogin']);

// Protected routes
Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'apiLogout']);
    Route::get('me', [AuthController::class, 'me']);
});

Route::post('/register/trucker', [AuthController::class, 'registerTrucker']);
Route::post('/register/civilian', [AuthController::class, 'registerCivilian']);



Route::middleware('auth:api')->group(function () {
    Route::get('/user/profile', [UserController::class, 'getProfile']);
    Route::post('/user/profile', [UserController::class, 'updateProfile']);
});
