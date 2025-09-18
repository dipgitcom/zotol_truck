@extends('backend.master')

@section('title', $dynamic->title)

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-3">

                {{-- Card Header --}}
                <div class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary fw-bold">
    <i class="bi bi-file-text me-2"></i> {{ $dynamic->title }}
</h5>
                    <a href="{{ route('dynamic.index') }}" class="btn btn-sm btn-secondary">
                        <i class="bi bi-arrow-left-circle me-1"></i> Back
                    </a>
                </div>

                {{-- Page Info --}}
                <div class="card-body">
                    <div class="mb-3">
                        <span class="badge bg-info text-dark">Slug:</span>
                        <span class="ms-2 text-muted">{{ $dynamic->slug }}</span>
                    </div>
                    <hr>

                    {{-- Page Content --}}
                    <div class="dynamic-content p-3 bg-light rounded-2 shadow-sm">
                        {!! $dynamic->content ?? '<p class="text-muted">No content available.</p>' !!}
                    </div>
                </div>

                {{-- Footer with actions --}}
                <div class="card-footer bg-white border-top-0 d-flex justify-content-end">
                    <a href="{{ route('dynamic.edit', $dynamic->id) }}" class="btn btn-sm btn-warning me-2 shadow-sm">
                        <i class="bi bi-pencil-square me-1"></i> Edit Page
                    </a>

                    <form action="{{ route('dynamic.destroy', $dynamic->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('Are you sure?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
/* Stretch container to be attached to sidebar */
.container-fluid {
    padding-left: 20px;
    padding-right: 20px;
}

/* Optional: style the content area */
.dynamic-content {
    min-height: 200px;
    font-size: 1rem;
    line-height: 1.6;
}

/* Adjust page-wrapper for sidebar alignment */
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
