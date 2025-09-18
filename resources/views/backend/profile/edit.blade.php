@extends('backend.master')

@section('title', 'Profile Settings')

@section('content')
<div class="container-fluid py-4">


    <!-- Update Profile Information -->
    <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg mb-4">
        <h3 class="fw-bold mb-3">Profile Settings</h3>
        <div class="max-w-xl">
            @include('backend.profile.partials.profile-header', ['user' => $user])
        </div>
    </div>

    <!-- Update Profile Information -->
    <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg mb-4">
        <h3 class="fw-bold mb-3">Update Profile Information</h3>
        <div class="max-w-xl">
            @include('backend.profile.partials.update-profile-information-form', ['user' => $user])
        </div>
    </div>

    <!-- Update Password -->
    <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg mb-4">
        <h3 class="fw-bold mb-3">Update Password</h3>
        <div class="max-w-xl">
            @include('backend.profile.partials.update-password-form', ['user' => $user])
        </div>
    </div>

    <!-- Delete Account -->
    <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg">
        <h3 class="fw-bold mb-3 text-danger">Delete Account</h3>
        <div class="max-w-xl">
            @include('backend.profile.partials.delete-user-form', ['user' => $user])
        </div>
    </div>

</div>
@endsection
