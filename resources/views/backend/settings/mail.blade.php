@extends('backend.master')

@section('title', 'Mail Settings')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-12 justify-content-center">
            <!-- Card -->
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-white">
                        <i class="bi bi-envelope me-2"></i> Mail Settings
                    </h5>
                    <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm">Back to Dashboard</a>
                </div>

                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('settings.mail.update') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <!-- Mail Mailer -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="mail_mailer" class="form-control" id="mail_mailer" 
                                           value="{{ $settings['mail_mailer'] ?? '' }}" placeholder="Mail Mailer">
                                    <label for="mail_mailer">Mail Mailer</label>
                                </div>
                            </div>

                            <!-- Mail Host -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="mail_host" class="form-control" id="mail_host" 
                                           value="{{ $settings['mail_host'] ?? '' }}" placeholder="Mail Host">
                                    <label for="mail_host">Mail Host</label>
                                </div>
                            </div>

                            <!-- Mail Port -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="mail_port" class="form-control" id="mail_port" 
                                           value="{{ $settings['mail_port'] ?? '' }}" placeholder="Mail Port">
                                    <label for="mail_port">Mail Port</label>
                                </div>
                            </div>

                            <!-- Mail Username -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="mail_username" class="form-control" id="mail_username" 
                                           value="{{ $settings['mail_username'] ?? '' }}" placeholder="Mail Username">
                                    <label for="mail_username">Mail Username</label>
                                </div>
                            </div>

                            <!-- Mail Password -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" name="mail_password" class="form-control" id="mail_password" 
                                           value="{{ $settings['mail_password'] ?? '' }}" placeholder="Mail Password">
                                    <label for="mail_password">Mail Password</label>
                                </div>
                            </div>

                            <!-- Mail From Address -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" name="mail_from_address" class="form-control" id="mail_from_address" 
                                           value="{{ $settings['mail_from_address'] ?? '' }}" placeholder="Mail From Address">
                                    <label for="mail_from_address">Mail From Address</label>
                                </div>
                            </div>

                            <!-- App Name (full width) -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="app_name" class="form-control" id="app_name" 
                                           value="{{ $settings['app_name'] ?? '' }}" placeholder="App Name">
                                    <label for="app_name">App Name</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
