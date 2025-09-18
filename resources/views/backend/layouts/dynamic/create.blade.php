@extends('backend.master')

@section('title', 'Add New Dynamic Page')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-3 w-100">

                {{-- Card Header --}}
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center shadow-sm rounded-top">
    <h5 class="mb-0 fw-bold text-white">
        <i class="bi bi-plus-circle me-2"></i> Add New Dynamic Page
    </h5>
    <a href="{{ route('dynamic.index') }}" class="btn btn-light btn-sm">
        <i class="bi bi-arrow-left-circle me-1"></i> Back
    </a>
</div>


                {{-- Form Body --}}
                <div class="card-body">
                    <form action="{{ route('dynamic.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">Page Title</label>
                            <input type="text" name="title" id="title" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   placeholder="Enter page title" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label fw-bold">Slug</label>
                            <input type="text" name="slug" id="slug" 
                                   class="form-control @error('slug') is-invalid @enderror" 
                                   placeholder="page-slug" required>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label fw-bold">Content</label>
                            <textarea name="content" id="content" rows="8" 
                                      class="form-control @error('content') is-invalid @enderror" 
                                      placeholder="Page content here..."></textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('dynamic.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Save Page
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
/* Ensure the card is attached to sidebar */
.container-fluid {
    padding-left: 20px;
    padding-right: 20px;
}
.card {
    margin-left: 0; /* remove any extra left margin */
}

/* Adjust page-wrapper for sidebar */
.page-wrapper {
    margin-left: 190px; /* full sidebar width */
    padding: 60px;
}

.navbar-vertical.collapsed + .page-wrapper,
.sidebar.collapsed + .page-wrapper {
    margin-left: 80px;
}

@media (max-width: 992px) {
    .page-wrapper {
        margin-left: 0 !important;
        padding: 15px;
    }
}
</style>
@endsection
