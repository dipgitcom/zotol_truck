<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PasswordOtpApiController;
use App\Http\Controllers\Api\OtpVerificationApiController;

// API login
Route::post('login', [AuthController::class, 'apiLogin']);

// Protected routes
Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'apiLogout']);
    Route::get('me', [AuthController::class, 'me']);
});

// Registration routes
Route::post('/register/trucker', [AuthController::class, 'registerTrucker']);
Route::post('/register/civilian', [AuthController::class, 'registerCivilian']);


// Password reset via OTP
Route::post('/password/send-otp', [PasswordOtpApiController::class, 'sendOtp']);
Route::post('/password/verify-otp', [PasswordOtpApiController::class, 'verifyOtp']);
Route::post('/password/reset', [PasswordOtpApiController::class, 'resetPassword']);


// OTP Verification for registration
Route::post('/otp/verify', [OtpVerificationApiController::class, 'verify']);
Route::post('/otp/resend', [OtpVerificationApiController::class, 'resend']);



Route::middleware('auth:api')->group(function () {
    Route::get('/user/profile', [UserController::class, 'getProfile']);
    Route::post('/user/profile', [UserController::class, 'updateProfile']);
});
