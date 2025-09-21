@extends('backend.master')

@section('content')
<div class="container mt-4">
    <h4>Edit Tag</h4>
    <form method="POST" action="{{ route('tags.update', $tag->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="tag_label" class="form-label">Tag Label</label>
            <input type="text" class="form-control @error('tag_label') is-invalid @enderror" id="tag_label" name="tag_label" value="{{ old('tag_label', $tag->tag_label) }}" required>
            
            @error('tag_label')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Tag</button>
        <a href="{{ route('tags.index') }}" class="btn btn-secondary">Back to Tags</a>
    </form>
</div>
@endsection
