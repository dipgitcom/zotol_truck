@extends('backend.master')

@section('title', 'Edit Role')

@section('content')
<div class="container-fluid py-4">

    {{-- Page Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-white">
                        <i class="bi bi-shield-lock me-2"></i> Edit Role
                    </h5>
                    <a href="{{ route('roles.index') }}" class="btn btn-sm btn-light">
                        <i class="bi bi-arrow-left-circle me-1"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Role Form --}}
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body">
                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Role Name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Role Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Role Name" value="{{ old('name', $role->name) }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Permissions --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Assign Permissions <span class="text-danger">*</span></label>
                            <div class="mb-2">
                                <input type="checkbox" id="select-all"> <label for="select-all" class="fw-bold">Select All</label>
                            </div>
                            <div class="row">
                                @foreach ($permissions as $permission)
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="perm-{{ $permission->id }}"
                                                {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="perm-{{ $permission->id }}">
                                                {{ ucfirst(str_replace('_', ' ', $permission->name)) }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('permissions')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save me-1"></i> Update Role
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    // Select All Permissions
    document.getElementById('select-all').addEventListener('change', function() {
        document.querySelectorAll('input[name="permissions[]"]').forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
</script>
@endpush
@endsection
