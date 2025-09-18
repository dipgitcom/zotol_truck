<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\PasswordOtpController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    // Registration
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::post('/register/trucker', [RegisteredUserController::class, 'storeTrucker'])->name('register.trucker');
    Route::post('/register/civilian', [RegisteredUserController::class, 'storeCivilian'])->name('register.civilian');
    

    // Login
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Show OTP form
    Route::get('forgot-password', [PasswordOtpController::class, 'showForgotForm'])->name('password.forgotForm');

    // Send OTP
    Route::post('forgot-password', [PasswordOtpController::class, 'sendOtp'])->name('password.sendOtp');

    // Verify OTP
    Route::get('verify-otp', [PasswordOtpController::class, 'showVerifyForm'])->name('password.otp.verifyForm');
    Route::post('verify-otp', [PasswordOtpController::class, 'verifyOtp'])->name('password.otp.verify');

    // Email OTP Verification for registration (should be accessible to guest)
   Route::get('/verify-otp', [App\Http\Controllers\Auth\OtpVerificationController::class, 'showForm'])->name('verify.otp.form');
   Route::post('/verify-otp', [App\Http\Controllers\Auth\OtpVerificationController::class, 'verify'])->name('verify.otp.verify');
   Route::post('/verify-otp/resend', [App\Http\Controllers\Auth\OtpVerificationController::class, 'resend'])
      ->middleware('throttle:3,1')->name('verify.otp.resend');


    // Reset new password
    Route::get('reset-password', [PasswordOtpController::class, 'showResetForm'])->name('password.reset.form');
    Route::post('reset-password', [PasswordOtpController::class, 'resetPassword'])->name('password.reset');

});

Route::middleware('auth')->group(function () {

    // Email verification
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
    

    // Confirm password
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Update password
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // Logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
