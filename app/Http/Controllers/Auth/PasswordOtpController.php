<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\PasswordOtpMail;
use App\Models\PasswordReset;


class PasswordOtpController extends Controller
{
    // Show the forgot password form
    public function showForgotForm()
    {
        return view('backend.auth.forgot-password'); // Blade view
    }

    // Send OTP to email
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $otp = rand(100000, 999999);

        // Save OTP in users table
        $user = User::where('email', $request->email)->first();
        $user->password_reset_otp = $otp;
        $user->password_reset_expires_at = now()->addMinutes(5);
        $user->save();


        // Send OTP via Mailable (Mailtrap configured in .env)
        Mail::to($request->email)->send(new PasswordOtpMail($user));

        return redirect()->route('password.otp.verifyForm')->with('email', $request->email)
                        ->with('success', 'OTP sent to your email.');
    }

    // Show OTP verification form
    public function showVerifyForm()
    {
        $email = session('email'); // email from previous step
        return view('backend.auth.verify-otp', compact('email'));
    }

    public function verifyOtp(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'otp'   => 'required|numeric',
    ]);

    $user = User::where('email', $request->email)
                ->where('password_reset_otp', $request->otp)
                ->where('password_reset_expires_at', '>=', now())
                ->first();

    if (!$user) {
        return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
    }

    // OTP valid → redirect to reset password page
    return view('backend.auth.reset-password', ['email' => $request->email]);
}



    // Show reset password form
    public function showResetForm(Request $request)
{
    $email = $request->query('email');
    return view('backend.auth.reset-password', compact('email'));
}

    // Reset the password
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

        return redirect()->route('login')->with('success', 'Password has been reset successfully!');
    }
}
