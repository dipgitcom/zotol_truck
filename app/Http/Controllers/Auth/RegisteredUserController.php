<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyOtpMail;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('backend.auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $otp = random_int(100000, 999999);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_otp' => Hash::make($otp),
            'email_otp_expires_at' => now()->addMinutes(5),
            'email_verified_at' => null,
        ]);

        Mail::to($user->email)->send(new VerifyOtpMail($user, $otp)); 

        session(['verification_email' => $user->email]);

        return redirect()->route('verify.otp.form')
                         ->with('status', 'A verification OTP has been sent to your email.');
    }

    public function storeTrucker(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $otp = random_int(100000, 999999);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_otp' => Hash::make($otp),
            'email_otp_expires_at' => now()->addMinutes(5),
            'email_verified_at' => null,
        ]);

        // Assign Trucker role to user
        $user->assignRole('Trucker');

        Mail::to($user->email)->send(new VerifyOtpMail($user, $otp)); 

        session(['verification_email' => $user->email]);

        return redirect()->route('verify.otp.form')
                         ->with('status', 'A verification OTP has been sent to your email.');
    }

    public function storeCivilian(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $otp = random_int(100000, 999999);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_otp' => Hash::make($otp),
            'email_otp_expires_at' => now()->addMinutes(5),
            'email_verified_at' => null,
        ]);

        // Assign Civilian role to user
        $user->assignRole('Civilian');

        Mail::to($user->email)->send(new VerifyOtpMail($user, $otp)); 

        session(['verification_email' => $user->email]);

        return redirect()->route('verify.otp.form')
                         ->with('status', 'A verification OTP has been sent to your email.');
    }
}
