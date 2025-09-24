@extends('backend.master')

@section('content')
<div class="container py-4">
  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-primary m-0">📌 All Posts</h3>
    <a href="{{ route('posts.create') }}" class="btn btn-primary shadow-sm">
      <i class="bi bi-plus-circle me-1"></i> New Post
    </a>
  </div>

  <!-- Posts Card -->
  <div class="card shadow-lg border-0 rounded-4">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table align-middle table-hover mb-0">
          <thead class="table-light">
            <tr>
              <th class="text-center">No</th>
              <th>Type</th>
              <th>Title & Description</th>
              <th>Tags</th>
              <th>Media</th>
              <th>Location</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($posts as $index => $post)
            <tr>
              <td class="text-center">{{ $posts->firstItem() + $index }}</td>
              <td>
                <span class="badge bg-gradient bg-primary px-3 py-2">
                  {{ ucfirst($post->post_type) }}
                </span>
              </td>
              <td>
                <div>
                  <span class="fw-semibold text-dark">{{ $post->title }}</span><br>
                  <small class="text-muted">{{ Str::limit($post->description, 60) }}</small>
                </div>
              </td>
              <td>
                @forelse($post->tags as $tag)
                  <span class="badge bg-info text-dark rounded-pill me-1">
                    #{{ $tag->tag_label }}
                  </span>
                @empty
                  <span class="text-muted">--</span>
                @endforelse
              </td>
              <td>
                <div class="d-flex flex-wrap gap-1">
                  @forelse($post->media as $media)
                    <img src="{{ Storage::url($media->media_url) }}" 
     class="rounded-3 border" 
     style="height:40px;width:40px;object-fit:cover;">

                  @empty
                    <span class="text-muted">--</span>
                  @endforelse
                </div>
              </td>
              <td>
                <div>
                  <strong>{{ $post->location->location_name ?? '--' }}</strong><br>
                  <small class="text-muted">
                    {{ $post->location->latitude ?? '' }}
                    {{ $post->location->longitude ? ", {$post->location->longitude}" : '' }}
                  </small>
                </div>
              </td>
              <td class="text-center">
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-outline-success me-1" title="Edit">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')" title="Delete">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" class="text-center text-muted py-4">
                <i class="bi bi-inbox fs-3"></i><br>
                No posts available.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- Pagination -->
    <div class="card-footer bg-light py-3">
      <div class="d-flex justify-content-between align-items-center">
        <small class="text-muted">
          Showing {{ $posts->firstItem() }} - {{ $posts->lastItem() }} of {{ $posts->total() }} results
        </small>
        {{ $posts->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
