<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\PasswordOtpMail;

class PasswordOtpApiController extends Controller
{
    // Send OTP to email for forgot password
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $otp = rand(100000, 999999);

        $user = User::where('email', $request->email)->first();

        // Hash OTP before saving for security
        $user->password_reset_otp = Hash::make($otp);
        $user->password_reset_expires_at = now()->addMinutes(5);
        $user->save();

        // Send OTP email with plain OTP (not hashed)
        Mail::to($request->email)->send(new PasswordOtpMail($user, $otp));

        return response()->json(['message' => 'OTP sent to your email.']);
    }

    // Verify OTP code
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        if (!$user->password_reset_otp) {
            return response()->json(['error' => 'No OTP found. Please request a new one.'], 422);
        }

        // Use Hash::check to verify OTP correctly
        if (!Hash::check($request->otp, $user->password_reset_otp)) {
            return response()->json(['error' => 'Invalid OTP.'], 422);
        }

        if (now()->gt($user->password_reset_expires_at)) {
            return response()->json(['error' => 'OTP expired.'], 422);
        }

        return response()->json(['message' => 'OTP verified. You can reset your password now.']);
    }

    // Reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        $user->password = bcrypt($request->password);
        $user->password_reset_otp = null;
        $user->password_reset_expires_at = null;
        $user->save();

        return response()->json(['message' => 'Password reset successfully.']);
    }
}
