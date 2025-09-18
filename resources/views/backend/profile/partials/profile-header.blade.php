<div class="card shadow-sm mb-4">
    <div class="card-body d-flex align-items-center">
        <!-- Profile Image -->
        <div class="me-3">
            <img alt="avatar" 
     src="{{ Auth::user()->profile_photo_url }}" 
     class="rounded-circle" width="40" height="40" />

        </div>

        <!-- User Info -->
        <div>
            <h4 class="mb-1">{{ $user->name }}</h4>
            <p class="text-muted mb-2">{{ $user->email }}</p>
            <span class="badge bg-success">Active User</span>
        </div>
    </div>
</div>