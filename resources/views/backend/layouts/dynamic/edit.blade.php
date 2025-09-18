@extends('backend.master')

@section('title', 'Edit Page - ' . $dynamic->title)

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-3">

                {{-- Card Header --}}
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
    <h5 class="mb-0 fw-bold text-white">
        <i class="bi bi-pencil-square me-2"></i> Edit Dynamic Page
    </h5>
    <a href="{{ route('dynamic.index') }}" class="btn btn-light btn-sm">
        <i class="bi bi-arrow-left-circle me-1"></i> Back
    </a>
</div>


                {{-- Form Body --}}
                <div class="card-body">
                    <form action="{{ route('dynamic.update', $dynamic->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label fw-bold">Page Title</label>
                                <input type="text" name="title" id="title" 
                                       class="form-control @error('title') is-invalid @enderror" 
                                       value="{{ old('title', $dynamic->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="slug" class="form-label fw-bold">Slug</label>
                                <input type="text" name="slug" id="slug" 
                                       class="form-control @error('slug') is-invalid @enderror" 
                                       value="{{ old('slug', $dynamic->slug) }}" required>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label fw-bold">Content</label>
                            <textarea name="content" id="content" rows="8" 
                                      class="form-control @error('content') is-invalid @enderror">{{ old('content', $dynamic->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('dynamic.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Update Page
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
/* Ensure the form stretches to the sidebar */
.container-fluid {
    padding-left: 20px;
    padding-right: 20px;
}

/* Adjust page-wrapper to respect sidebar width */
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
