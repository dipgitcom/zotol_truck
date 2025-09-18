@extends('backend.guest')

@section('title', 'Login')

@section('content')
<div class="card shadow-sm p-4 text-center" style="width: 400px;">

    <!-- Logo -->
    <div class="mb-4">
        <a href="{{ url('/') }}">
            <img src="{{ asset(get_setting('APP_LOGO', 'backend/assets/images/brand/logo/logo-2.svg')) }}" 
                 alt="{{ get_setting('APP_NAME', 'Dashboard') }}" height="100" />
        </a>
    </div>

    <h3 class="mb-4">Login</h3>

    <!-- Success/Status Message -->
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-3 text-start">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3 text-start">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" required>
            @error('password')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-check mb-3 text-start">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <!-- Forgot Password link (updated) -->
            <a href="{{ route('password.forgotForm') }}" class="text-decoration-none small">
                {{ __('Forgot your password?') }}
            </a>

            <button type="submit" class="btn btn-primary">
                {{ __('Log in') }}
            </button>
        </div>
         {{-- <!-- Register link (only for users) -->
    <div class="mt-3">
        <span class="small">Don’t have an account?</span>
        <a href="{{ route('register') }}" class="small fw-bold text-decoration-none">Register</a>
    </div> --}}
    </form>
</div>
@endsection
