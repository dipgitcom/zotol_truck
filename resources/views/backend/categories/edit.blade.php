@extends('backend.master')

@section('title', 'Edit Category')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0 rounded-3">
                <!-- Card Header -->
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-white"><i class="bi bi-pencil-square me-2"></i> Edit Category</h5>
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

                    <form method="POST" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data">
                        @csrf 
                        @method('PUT')

                        <div class="row g-3">
                            <!-- Category Name -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Category Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control form-control-lg" value="{{ old('name', $category->name) }}" required>
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Slug -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Slug <span class="text-danger">*</span></label>
                                <input type="text" name="slug" class="form-control form-control-lg" value="{{ old('slug', $category->slug) }}" required>
                                @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="mb-3 mt-3">
                            <label class="form-label fw-bold">Category Image</label>
                            @if ($category->image)
                                <div class="mb-2">
                                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="img-thumbnail" style="max-width:150px; border:1px solid #ddd; padding:3px;">
                                </div>
                            @endif
                            <input type="file" name="image" class="form-control form-control-sm">
                            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-3 form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" value="1" id="statusSwitch"
                                   {{ old('status', $category->status) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="statusSwitch">Active</label>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" class="form-control" rows="4" placeholder="Enter category description">{{ old('description', $category->description) }}</textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save me-1"></i> Update Category
                            </button>
                            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle me-1"></i> Cancel
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection