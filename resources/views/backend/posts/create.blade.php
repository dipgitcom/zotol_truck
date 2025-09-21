@extends('backend.master')

@section('content')
<div class="container py-4">
  <!-- Page Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-primary m-0">📝 Create New Post</h3>
    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">
      <i class="bi bi-arrow-left"></i> Back to Posts
    </a>
  </div>

  <!-- Form Card -->
  <div class="card shadow-lg border-0 rounded-4">
    <div class="card-body p-4">
      <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Post Type -->
        <div class="mb-3">
          <label class="form-label fw-semibold">
            <i class="bi bi-list-task me-1"></i> Post Type
          </label>
          <select name="post_type" class="form-select" required>
            <option value="incident">🚨 Incident</option>
            <option value="daily">📅 Daily</option>
          </select>
        </div>

        <!-- Title -->
        <div class="mb-3">
          <label class="form-label fw-semibold">
            <i class="bi bi-type me-1"></i> Title
          </label>
          <input type="text" class="form-control" name="title" placeholder="Enter a catchy title..." required>
        </div>

        <!-- Description -->
        <div class="mb-3">
          <label class="form-label fw-semibold">
            <i class="bi bi-card-text me-1"></i> Description
          </label>
          <textarea class="form-control" name="description" rows="3" placeholder="Write a short description (optional)..."></textarea>
        </div>

        <!-- Tags -->
        <div class="mb-3">
          <label class="form-label fw-semibold">
            <i class="bi bi-tags me-1"></i> Tags
          </label>
          <input type="text" name="tags[]" class="form-control" placeholder="Add a tag (e.g. accident, traffic)">
          <small class="text-muted">Press Enter after typing each tag</small>
        </div>

        <!-- Media Upload -->
        <div class="mb-3">
          <label class="form-label fw-semibold">
            <i class="bi bi-image me-1"></i> Upload Media
          </label>
          <input type="file" name="photo[]" class="form-control" multiple>
          <small class="text-muted">You can upload multiple photos/videos</small>
        </div>

        <!-- Location -->
        <div class="mb-3">
          <label class="form-label fw-semibold">
            <i class="bi bi-geo-alt me-1"></i> Location
          </label>
          <div class="row g-2">
            <div class="col-md-6">
              <input type="text" name="location_name" class="form-control" placeholder="Location name">
            </div>
            <div class="col-md-3">
              <input type="text" name="latitude" class="form-control" placeholder="Latitude">
            </div>
            <div class="col-md-3">
              <input type="text" name="longitude" class="form-control" placeholder="Longitude">
            </div>
          </div>
          <input type="text" name="distance" class="form-control mt-2" placeholder="Distance (e.g. 5km)">
        </div>

        <!-- Incident Area -->
        <div class="mb-3">
          <label class="form-label fw-semibold">
            <i class="bi bi-arrows-expand me-1"></i> Approx. Incident Area
          </label>
          <input type="text" name="incident_area" class="form-control" placeholder="e.g. 150 miles">
        </div>

        <!-- Submit -->
        <div class="d-flex justify-content-end mt-4">
          <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-check-circle me-1"></i> Post
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
