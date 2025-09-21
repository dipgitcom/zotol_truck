@extends('backend.master')

@section('content')
<div class="container py-4">
  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-primary m-0">🏷️ Tags</h3>
    <a href="{{ route('tags.create') }}" class="btn btn-primary shadow-sm">
      <i class="bi bi-plus-circle me-1"></i> Add New Tag
    </a>
  </div>

  <!-- Tags Table -->
  <div class="card shadow-lg border-0 rounded-4">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table align-middle table-hover mb-0">
          <thead class="table-light">
            <tr>
              <th class="text-center" style="width: 80px;">ID</th>
              <th>Tag Label</th>
              <th class="text-center" style="width: 180px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($tags as $tag)
              <tr>
                <td class="text-center fw-semibold">{{ $tag->id }}</td>
                <td>
                  <span class="badge bg-info text-dark fs-6 px-3 py-2">
                    #{{ $tag->tag_label }}
                  </span>
                </td>
                <td class="text-center">
                  <a href="{{ route('tags.edit', $tag) }}" class="btn btn-sm btn-outline-success me-1" title="Edit">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <form method="POST" action="{{ route('tags.destroy', $tag) }}" 
                        class="d-inline"
                        onsubmit="return confirm('Are you sure you want to delete this tag?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="3" class="text-center text-muted py-4">
                  <i class="bi bi-inbox fs-3"></i><br>
                  No tags available.
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
          Showing {{ $tags->firstItem() }} - {{ $tags->lastItem() }} of {{ $tags->total() }} results
        </small>
        {{ $tags->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
