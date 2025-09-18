@component('mail::message')
# Verify your email

Hello {{ $user->name }},

Thanks for registering. Use the OTP below to verify your email. It will expire in **5 minutes**.

@component('mail::panel')
## {{ $otp }}
@endcomponent

If you didn't request this, please ignore this email.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
