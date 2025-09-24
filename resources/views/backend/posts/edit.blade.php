@extends('backend.master')

@section('content')
<div class="container py-4">
  <h3 class="fw-bold text-primary mb-3">Edit Post</h3>

  <div class="card shadow-lg rounded-3">
    <div class="card-body">
      <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Post Type -->
        <div class="mb-3">
          <label class="form-label fw-semibold">Post Type</label>
          <select name="post_type" class="form-select" required>
            <option value="incident" {{ $post->post_type == 'incident' ? 'selected' : '' }}>Incident</option>
            <option value="daily" {{ $post->post_type == 'daily' ? 'selected' : '' }}>Daily</option>
          </select>
        </div>

        <!-- Title -->
        <div class="mb-3">
          <label class="form-label fw-semibold">Title</label>
          <input type="text" class="form-control" name="title" value="{{ $post->title }}" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
          <label class="form-label fw-semibold">Description</label>
          <textarea class="form-control" rows="3" name="description">{{ $post->description }}</textarea>
        </div>

        <!-- Tags -->
        <div class="mb-3">
          <label class="form-label fw-semibold">Tags (comma separated)</label>
          <input type="text" name="tags" class="form-control"
                 value="{{ $post->tags->pluck('tag_label')->implode(', ') }}"
                 placeholder="Enter tags separated by comma">
        </div>

        <!-- Current Media -->
        <div class="mb-3">
          <label class="form-label fw-semibold">Current Media</label>
          <div class="d-flex flex-wrap mb-2">
            @forelse($post->media as $media)
              <div class="position-relative me-2 mb-2">
                <img src="{{ asset('storage/' . $media->media_url) }}" 
                     class="rounded border" style="height:70px;width:70px;object-fit:cover;">
                <form method="POST" action="{{ route('posts.destroy', $media->id) }}"
                      class="position-absolute top-0 end-0">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger p-1"
                          onclick="return confirm('Delete this media?');">×</button>
                </form>
              </div>
            @empty
              <span class="text-muted">No media uploaded</span>
            @endforelse
          </div>
        </div>

        <!-- Upload New Media -->
        <div class="mb-3">
          <label class="form-label fw-semibold">Upload New Photo/Video</label>
          <input type="file" name="photo[]" class="form-control" multiple>
        </div>

        <!-- Location -->
        <div class="mb-3">
          <label class="form-label fw-semibold">Location</label>
          <input type="text" name="location_name" class="form-control mb-2"
                 value="{{ $post->location->location_name ?? '' }}" placeholder="Location name">
          <div class="row">
            <div class="col-md-4">
              <input type="text" name="latitude" class="form-control mb-2"
                     value="{{ $post->location->latitude ?? '' }}" placeholder="Latitude">
            </div>
            <div class="col-md-4">
              <input type="text" name="longitude" class="form-control mb-2"
                     value="{{ $post->location->longitude ?? '' }}" placeholder="Longitude">
            </div>
            <div class="col-md-4">
              <input type="text" name="distance" class="form-control mb-2"
                     value="{{ $post->location->distance ?? '' }}" placeholder="Distance">
            </div>
          </div>
        </div>

        <!-- Incident Area -->
        <div class="mb-3">
          <label class="form-label fw-semibold">Approx. Incident Area</label>
          <input type="text" name="incident_area" class="form-control"
                 value="{{ $post->incident_area ?? '' }}" placeholder="e.g. 150 miles">
        </div>

        <!-- Submit -->
        <div class="d-flex justify-content-end">
          <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
          <button type="submit" class="btn btn-primary">Update Post</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
