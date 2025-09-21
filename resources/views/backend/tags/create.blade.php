@extends('backend.master')

@section('content')
<div class="container mt-4">
    <h4>Create New Tag</h4>
    <form method="POST" action="{{ route('tags.store') }}">
        @csrf
        <div class="mb-3">
            <label for="tag_label" class="form-label">Tag Label</label>
            <input type="text" class="form-control @error('tag_label') is-invalid @enderror" id="tag_label" name="tag_label" value="{{ old('tag_label') }}" required>
            
            @error('tag_label')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create Tag</button>
        <a href="{{ route('tags.index') }}" class="btn btn-secondary">Back to Tags</a>
    </form>
</div>
@endsection
