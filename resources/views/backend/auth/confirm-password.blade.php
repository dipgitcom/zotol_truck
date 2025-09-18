@extends('backend.guest') <!-- Your custom guest layout -->

@section('title', 'Confirm Password')

@section('content')
<div class="text-center mb-4">
    <a href="{{ url('/') }}">
        <img src="{{ asset('backend/assets/images/brand/logo/logo-2.svg') }}" alt="Logo" height="50">
    </a>
</div>

<div class="mb-4 text-muted">
    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
</div>

<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <!-- Password -->
    <div class="mb-3">
        <x-input-label for="password" :value="__('Password')" />
        <x-text-input id="password" class="form-control mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
    </div>

    <div class="d-flex justify-end mt-4">
        <x-primary-button class="btn btn-primary">
            {{ __('Confirm') }}
        </x-primary-button>
    </div>
</form>
@endsection
