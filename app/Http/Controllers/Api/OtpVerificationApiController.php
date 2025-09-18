<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyOtpMail;

class OtpVerificationApiController extends Controller
{
    // Verify user OTP
    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        if (!Hash::check($request->otp, $user->email_otp)) {
    return response()->json(['error' => 'Invalid OTP.'], 422);
}


        if (now()->gt($user->email_otp_expires_at)) {
            return response()->json(['error' => 'OTP expired.'], 422);
        }

        $user->email_verified_at = now();
        $user->email_otp = null;
        $user->email_otp_expires_at = null;
        $user->save();

        return response()->json(['message' => 'Your email has been verified.']);
    }

    // Resend OTP
    public function resend(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        $otp = random_int(100000, 999999);

        $user->email_otp = Hash::make($otp);
        $user->email_otp_expires_at = now()->addMinutes(10);
        $user->save();

        try {
            Mail::to($user->email)->send(new VerifyOtpMail($user, $otp));
        } catch (\Exception $e) {
            \Log::error('Failed to send OTP mail: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send OTP email. Please try again later.'], 500);
        }

        return response()->json(['message' => 'A new OTP has been sent to your email.']);
    }
}
