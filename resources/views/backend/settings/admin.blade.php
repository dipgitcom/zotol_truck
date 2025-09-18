@extends('backend.master')

@section('title', 'Admin Settings')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-12">
            <!-- Card -->
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-white">
                        <i class="bi bi-gear me-2"></i> Admin Settings
                    </h5>
                </div>

                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('settings.admin.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <!-- App Name -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" id="APP_NAME" name="APP_NAME" class="form-control" 
                                           value="{{ old('APP_NAME', get_setting('APP_NAME')) }}" 
                                           placeholder="App Name" required>
                                    <label for="APP_NAME">App Name</label>
                                </div>
                            </div>

                            <!-- App URL -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="url" id="APP_URL" name="APP_URL" class="form-control" 
                                           value="{{ old('APP_URL', get_setting('APP_URL')) }}" 
                                           placeholder="App URL" required>
                                    <label for="APP_URL">App URL</label>
                                </div>
                            </div>

                            <!-- Debug Mode -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select id="APP_DEBUG" name="APP_DEBUG" class="form-select">
                                        <option value="true" {{ get_setting('APP_DEBUG') == 'true' ? 'selected' : '' }}>True</option>
                                        <option value="false" {{ get_setting('APP_DEBUG') == 'false' ? 'selected' : '' }}>False</option>
                                    </select>
                                    <label for="APP_DEBUG">Debug Mode</label>
                                </div>
                            </div>

                            <!-- App Logo -->
                            <div class="col-md-6">
                                <label for="APP_LOGO" class="form-label fw-bold">Logo</label>
                                <input type="file" id="APP_LOGO" name="APP_LOGO" class="form-control">
                                <div class="mt-2">
                                    <img src="{{ get_setting('APP_LOGO', asset('assets/images/brand/logo/logo-2.svg')) }}" 
                                         alt="App Logo" 
                                         class="img-fluid" 
                                         style="max-height:200px; width:auto; border:1px solid #ddd; padding:5px;">
                                </div>
                            </div>

                            <!-- Favicon -->
                            <div class="col-md-6">
                                <label for="APP_FAVICON" class="form-label fw-bold">Favicon</label>
                                <input type="file" id="APP_FAVICON" name="APP_FAVICON" class="form-control">
                                <div class="mt-2">
                                    <img src="{{ asset(get_setting('APP_FAVICON', 'favicon.ico')) }}?v={{ time() }}" 
                                         alt="App Favicon" 
                                         style="height:60px; width:auto; border:1px solid #ddd; padding:3px;">
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
