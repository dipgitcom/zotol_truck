@extends('backend.guest')

@section('title', 'Verify OTP')

@section('content')
<div class="card shadow-sm p-4 text-center" style="width: 400px;">
    <!-- Logo -->
    <div class="mb-4">
        <a href="{{ url('/') }}">
            <img src="{{ asset(get_setting('APP_LOGO', 'backend/assets/images/brand/logo/logo-2.svg')) }}" 
                 alt="{{ get_setting('APP_NAME', 'Dashboard') }}" height="100" />
        </a>
    </div>

    <h4 class="mb-3">Enter OTP</h4>
    <p class="text-muted small mb-4">
        We sent a 6-digit OTP to <b>{{ $email }}</b>. Enter it below to continue.
    </p>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.otp.verify') }}">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="mb-3 text-start">
            <label for="otp" class="form-label">OTP Code</label>
            <input id="otp" type="text" class="form-control @error('otp') is-invalid @enderror"
                   name="otp" required autofocus>
            @error('otp')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="d-grid mt-3">
            <button type="submit" class="btn btn-primary">
                Verify OTP
            </button>
        </div>
    </form>
</div>
@endsection
