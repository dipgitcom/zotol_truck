@extends('backend.master')

@section('title', 'Create Category')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0 rounded-3">
                <!-- Card Header -->
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-white"><i class="bi bi-plus-circle me-2"></i> Create Category</h5>
                    <a href="{{ route('categories.index') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left-circle me-1"></i> Back to List
                    </a>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            {{-- Category Name --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Category Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control form-control-lg" placeholder="Enter category name" required>
                            </div>

                            {{-- Slug --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Slug</label>
                                <input type="text" name="slug" class="form-control form-control-lg" placeholder="Auto-generated or type manually">
                            </div>
                        </div>

                        {{-- Image --}}
                        <div class="mb-3 mt-3">
                            <label class="form-label fw-bold">Category Image</label>
                            <input type="file" name="image" class="form-control form-control-sm">
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" rows="4" class="form-control" placeholder="Write a short description"></textarea>
                        </div>

                        {{-- Status --}}
                        <div class="mb-3 form-check form-switch">
                            <input type="checkbox" name="status" class="form-check-input" id="statusSwitch" checked>
                            <label class="form-check-label fw-bold" for="statusSwitch">Active</label>
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Save Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
