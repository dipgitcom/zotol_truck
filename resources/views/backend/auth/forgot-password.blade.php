@extends('backend.guest')

@section('title', 'Forgot Password (OTP)')

@section('content')
<div class="card shadow-sm p-4 text-center" style="width: 400px;">
    
    <!-- Logo -->
    <div class="mb-4">
        <a href="{{ url('/') }}">
            <img src="{{ asset(get_setting('APP_LOGO', 'backend/assets/images/brand/logo/logo-2.svg')) }}" 
                     alt="{{ get_setting('APP_NAME', 'Dashboard') }}" height="100" />
        </a>
    </div>
    
    <h4 class="mb-3">Forgot Password?</h4>
    <form method="POST" action="{{ route('password.sendOtp') }}">
        @csrf
        <div class="mb-3 text-start">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Send OTP</button>
    </form>
</div>
</div>
@endsection
