@extends('backend.guest')

@section('title', 'Verify Email')

@section('content')
<div class="card shadow-sm p-4 text-center" style="width: 500px;">
    
    <!-- Logo -->
    <div class="mb-4">
        <a href="{{ url('/') }}">
            <img src="{{ asset(get_setting('APP_LOGO', 'backend/assets/images/brand/logo/logo-2.svg')) }}" 
                 alt="{{ get_setting('APP_NAME', 'Dashboard') }}" height="80" />
        </a>
    </div>

    <h3 class="mb-3">Verify Your Email</h3>
    <p class="text-muted small mb-4">
        Thanks for signing up! Before getting started, please confirm your email address by
        clicking the verification link we just sent to your inbox.  
        If you didn’t receive the email, we’ll happily send you another.
    </p>

    <!-- Status -->
    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success small mb-4">
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif

    <!-- Resend Verification Form -->
    <form method="POST" action="{{ route('verification.send') }}" class="d-grid mb-3">
        @csrf
        <button type="submit" class="btn btn-primary w-100">
            Resend Verification Email
        </button>
    </form>

    <!-- Logout Form -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-secondary w-100">
            Log Out
        </button>
    </form>
</div>
@endsection
