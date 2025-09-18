@extends('backend.guest')

@section('title', 'OTP for Password Reset')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Password Reset OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 8px;
            border: 1px solid #e3e6ea;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            padding: 30px;
            text-align: center;
        }
        .logo {
            margin-bottom: 20px;
        }
        .otp-box {
            display: inline-block;
            padding: 12px 20px;
            margin: 20px 0;
            background-color: #007bff;
            color: #ffffff;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 2px;
            border-radius: 6px;
        }
        .footer {
            font-size: 12px;
            color: #6c757d;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Optional Logo -->
        <div class="logo">
            <img src="{{ asset(get_setting('APP_LOGO', 'backend/assets/images/brand/logo/logo-2.svg')) }}" 
                 alt="{{ get_setting('APP_NAME', 'Dashboard') }}" height="50">
        </div>

        <h2>Password Reset Request</h2>
        <p>Hello {{ $user->name ?? 'User' }},</p>
        <p>You requested to reset your password. Use the OTP below to proceed:</p>

        <div class="otp-box">
            {{ $user->password_reset_otp }}
        </div>

        <p>This OTP is valid for <strong>5 minutes</strong>. If you did not request this, you can ignore this email.</p>

        <div class="footer">
            <p>Thank you,<br>{{ get_setting('APP_NAME', 'Dashboard') }}</p>
        </div>
    </div>
</body>
</html>
@endsection
