@extends('backend.master')

@section('title', 'All Users')

@section('content')
<div class="container-fluid py-4">
    <div class="row g-4">
        <!-- Left Panel: Users List -->
        <div class="col-lg-5">
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-white">
                        <i class="bi bi-people me-2"></i> Users
                    </h5>
                    <a href="{{ route('users.create') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Add
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $u)
                                    <tr @if(isset($selectedUser) && $selectedUser->id == $u->id) class="table-primary" @endif>
                                        <td>
                                            <a href="{{ route('users.index', ['selected' => $u->id]) }}" class="text-decoration-none fw-medium">
                                                {{ $u->name }}
                                            </a>
                                        </td>
                                        <td class="text-muted">{{ $u->email }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel: User Details -->
        <div class="col-lg-7">
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-white">
                        <i class="bi bi-person-badge me-2"></i> User Details
                    </h5>
                    @if(isset($selectedUser))
                        <form action="{{ route('users.destroy', $selectedUser->id) }}" method="POST" class="mb-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                <i class="bi bi-trash me-1"></i> Delete
                            </button>
                        </form>
                    @endif
                </div>
                <div class="card-body p-4">
                    @if(isset($selectedUser))
                        <form action="{{ route('users.update', $selectedUser->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="name" class="form-control" value="{{ $selectedUser->name }}" placeholder="Name" required>
                                        <label>Name <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" name="email" class="form-control" value="{{ $selectedUser->email }}" placeholder="Email" required>
                                        <label>Email <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="roles" class="form-control" value="{{ $selectedUser->roles->pluck('name')->join(', ') }}" placeholder="Roles">
                                        <label>Roles</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
                                        <label>Password</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i> Save Changes
                                </button>
                                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left-circle me-1"></i> Back
                                </a>
                            </div>
                        </form>
                    @else
                        <p class="text-muted fst-italic">Select a user from the list to view and edit details.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
