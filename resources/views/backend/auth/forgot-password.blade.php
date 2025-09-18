@extends('backend.guest')

@section('title', 'Forgot Password (OTP)')

@section('content')
<div class="card shadow-sm p-4 text-center" style="width: 400px; margin:auto;">
    
    <!-- Logo -->
    <div class="mb-4">
        <a href="{{ url('/') }}">
            <img src="{{ asset(get_setting('APP_LOGO', 'backend/assets/images/brand/logo/logo-2.svg')) }}" 
                 alt="{{ get_setting('APP_NAME', 'Dashboard') }}" height="100" />
        </a>
    </div>
    
    <h4 class="mb-3">Forgot Password?</h4>
    <p class="text-muted small mb-4">Enter your email, and we’ll send you a one-time OTP code.</p>

    <form method="POST" action="{{ route('password.sendOtp') }}">
        @csrf
        <div class="mb-3 text-start">
            <label>Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <button type="submit" class="btn btn-primary w-100">Send OTP</button>
    </form>
</div>
@endsection
