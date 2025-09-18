@extends('backend.guest')

@section('title', 'Verify OTP')

@section('content')
<div class="card shadow-sm p-4 text-center" style="width: 400px;">
    <div class="mb-4">
        <a href="{{ url('/') }}">
            <img src="{{ asset(get_setting('APP_LOGO')) }}" alt="{{ get_setting('APP_NAME') }}" height="100" />
        </a>
    </div>

    <h4 class="mb-3">Enter OTP</h4>
    <p class="text-muted small mb-4">
        We sent a 6-digit OTP to <b>{{ $email }}</b>. Enter it below to continue.
    </p>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('verify.otp.verify') }}">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="mb-3 text-start">
            <label for="otp" class="form-label">OTP Code</label>
            <input id="otp" type="text" class="form-control @error('otp') is-invalid @enderror" name="otp" required autofocus>
            @error('otp')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="d-grid mt-3">
            <button type="submit" class="btn btn-primary">Verify OTP</button>
        </div>
    </form>

    {{-- Resend OTP Option --}}
    <div class="mt-3">
        <form method="POST" action="{{ route('verify.otp.resend') }}">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Resend OTP</button>
        </form>
    </div>

</div>
@endsection
