<div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg mb-4">
    
    <p class="text-muted">
        Once your account is deleted, all of its resources and data will be permanently deleted. 
        Please enter your password to confirm deletion.
    </p>

    <form method="POST" action="{{ route('profile.destroy') }}">
        @csrf
        @method('DELETE')

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary me-2">Cancel</a>
            <button type="submit" class="btn btn-danger">Delete Account</button>
        </div>
    </form>
</div>
