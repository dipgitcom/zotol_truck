@extends('backend.master')

@section('title', 'Create Role')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0 rounded-3">

                {{-- Header --}}
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-white">
                        <i class="bi bi-shield-lock me-2"></i> Create Role
                    </h5>
                    <a href="{{ route('roles.index') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left-circle me-1"></i> Back
                    </a>
                </div>

                {{-- Form --}}
                <div class="card-body">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf

                        {{-- Role Name --}}
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">Role Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg" placeholder="Enter Role Name" value="{{ old('name') }}" required>
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Permissions --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Assign Permissions</label>
                            <div class="mb-2">
                                <input type="checkbox" id="select-all"> 
                                <label for="select-all" class="fw-semibold">Select All</label>
                            </div>
                            <div class="row g-3">
                                @foreach ($permissions as $permission)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="perm-{{ $permission->id }}">
                                            <label class="form-check-label" for="perm-{{ $permission->id }}">
                                                {{ ucfirst(str_replace('_', ' ', $permission->name)) }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('permissions') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Submit --}}
                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-save me-1"></i> Save Role
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

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
