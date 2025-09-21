@extends('backend.master')

@section('content')
<div class="container py-4">

  <!-- Comment Form -->
  <div class="card shadow-sm border-0 rounded-3 mb-4">
    <div class="card-body">
      <h5 class="fw-bold text-primary mb-3">
        💬 Add a Comment
      </h5>
      <form method="POST" action="{{ route('comments.store') }}">
        @csrf
        <input type="hidden" name="post_id" value="{{ old('post_id', $postId ?? '') }}">

        <div class="mb-3">
          <textarea name="comment_text" class="form-control" rows="3" placeholder="Write your comment..." required></textarea>
        </div>
        <div class="d-flex justify-content-end">
          <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-send"></i> Post Comment
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Comments Section -->
  <h5 class="fw-bold text-dark mb-3">All Comments</h5>

  @forelse ($comments as $comment)
    <div class="card shadow-sm border-0 rounded-3 mb-3">
      <div class="card-body d-flex">
        <!-- User Avatar -->
        <div class="me-3">
          <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" 
               style="width:40px; height:40px; font-size:14px;">
            {{ strtoupper(substr($comment->user->name, 0, 1)) }}
          </div>
        </div>

        <!-- Comment Content -->
        <div class="flex-grow-1">
          <div class="d-flex justify-content-between">
            <strong>{{ $comment->user->name }}</strong>
            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
          </div>
          <p class="mb-1">{{ $comment->comment_text }}</p>

          <!-- Replies -->
          @if($comment->replies && $comment->replies->count())
            <div class="ms-4 mt-3 border-start ps-3">
              @foreach($comment->replies as $reply)
                <div class="mb-2">
                  <strong>{{ $reply->user->name }}</strong>
                  <small class="text-muted">• {{ $reply->created_at->diffForHumans() }}</small>
                  <p class="mb-1">{{ $reply->comment_text }}</p>
                </div>
              @endforeach
            </div>
          @endif

          <!-- Reply Form -->
          <form method="POST" action="{{ route('comments.store') }}" class="mt-2">
            @csrf
            <input type="hidden" name="post_id" value="{{ old('post_id', $postId ?? '') }}">
            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
            <div class="input-group">
              <input type="text" name="comment_text" class="form-control" placeholder="Reply..." required>
              <button class="btn btn-outline-primary" type="submit">
                <i class="bi bi-reply"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  @empty
    <div class="text-muted">No comments yet. Be the first one! 🚀</div>
  @endforelse

  <!-- Pagination -->
  <div class="mt-4">
    {{ $comments->links() }}
  </div>

</div>
@endsection
