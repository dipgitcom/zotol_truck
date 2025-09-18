<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyOtpMail;


class OtpVerificationController extends Controller
{
    public function showForm()
    {
        $email = session('verification_email');

        if (!$email) {
            return redirect()->route('verify.otp.form')->with('error', 'No email to verify.');
        }

        return view('backend.auth.emails.verify-otp', compact('email'));
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'User not found.']);
        }

        if (!Hash::check($request->otp, $user->email_otp)) {
            return redirect()->back()->withErrors(['otp' => 'Invalid OTP.']);
        }

        if (now()->gt($user->email_otp_expires_at)) {
            return redirect()->back()->withErrors(['otp' => 'OTP expired.']);
        }

        // Mark email verified
        $user->email_verified_at = now();
        $user->email_otp = null;
        $user->email_otp_expires_at = null;
        $user->save();

        // // Log in the user
        // Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Your email has been verified and you are logged in.');
    }

    public function resend(Request $request)
{
    $request->validate(['email' => 'required|email']);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return redirect()->back()->withErrors(['email' => 'User not found.']);
    }

    $otp = random_int(100000, 999999);

    $user->email_otp = Hash::make($otp);
    $user->email_otp_expires_at = now()->addMinutes(10);
    $user->save();

    try {
        Mail::to($user->email)->send(new VerifyOtpMail($user, $otp));
    } catch (\Exception $e) {
        \Log::error('Failed to send OTP mail: ' . $e->getMessage());
        return redirect()->back()->withErrors('Failed to send OTP email. Please try again later.');
    }

    return redirect()->back()->with('status', 'A new OTP has been sent to your email.');
}


}
