@extends('backend.guest')

@section('title', 'Reset Password with OTP')

@section('content')
<div class="card shadow-sm p-4 text-center" style="width:400px; margin:auto;">
     <!-- Logo -->
    <div class="mb-4">
        <a href="{{ url('/') }}">
            <img src="{{ asset(get_setting('APP_LOGO', 'backend/assets/images/brand/logo/logo-2.svg')) }}" 
                 alt="{{ get_setting('APP_NAME', 'Dashboard') }}" height="100" />
        </a>
    </div>
    
    <h4 class="mb-3">Reset Password</h4>
    <p class="text-muted small mb-4">Enter your new password for <b>{{ $email }}</b></p>

    <form method="POST" action="{{ route('password.reset') }}">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="mb-3 text-start">
            <label>New Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3 text-start">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Reset Password</button>
    </form>
</div>
@endsection
