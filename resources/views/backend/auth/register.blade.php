@extends('backend.guest') <!-- your custom guest layout -->

@section('title', 'Register')

@section('content')
<div class="card shadow-sm p-4 text-center" style="width: 400px; margin: auto;">

    <!-- Logo -->
    <div class="mb-4">
        <a href="{{ url('/') }}">
            <img src="{{ asset(get_setting('APP_LOGO', 'backend/assets/images/brand/logo/logo-2.svg')) }}" 
                 alt="{{ get_setting('APP_NAME', 'Dashboard') }}" height="60" />
        </a>
    </div>

    <h3 class="mb-4">Register</h3>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3 text-start">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}" required autofocus>
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-3 text-start">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" required>
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3 text-start">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   required>
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3 text-start">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror" required>
            @error('password_confirmation')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Actions -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <a class="text-decoration-none small" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</div>
@endsection
