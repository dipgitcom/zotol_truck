<div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg mb-4">
    
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <!-- Current Password -->
        <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <input id="current_password" type="password" name="current_password"
                   class="form-control @error('current_password') is-invalid @enderror"
                   autocomplete="current-password" required>
            @error('current_password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- New Password -->
        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input id="password" type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   autocomplete="new-password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   autocomplete="new-password" required>
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save</button>

        @if (session('status') === 'password-updated')
            <div class="alert alert-success mt-3">
                Password updated successfully!
            </div>
        @endif
    </form>
</div>
