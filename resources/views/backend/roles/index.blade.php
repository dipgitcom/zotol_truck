@extends('backend.master')
@section('title', 'Roles List')

@section('content')
<div class="container-fluid py-4">

    {{-- Page Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-white">
                        <i class="bi bi-shield-lock me-2"></i> Roles List
                    </h5>
                    <a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Add Role
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Roles Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="rolesTable" class="table table-hover table-bordered mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Role Name</th>
                                    <th>Permissions</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($roles as $key => $role)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ ucfirst($role->name) }}</td>
                                    <td>
                                        @if($role->permissions->count() > 0)
                                            @foreach($role->permissions as $permission)
                                                <span class="badge bg-primary mb-1">{{ ucfirst(str_replace('_', ' ', $permission->name)) }}</span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">No Permissions</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
    <div class="btn-group" role="group" aria-label="Role Actions">

        {{-- Edit Button --}}
        <a href="{{ route('roles.edit', $role->id) }}" 
           class="btn btn-sm btn-outline-primary" 
           data-bs-toggle="tooltip" 
           data-bs-placement="top" 
           title="Edit Role">
            <i class="bi bi-pencil-square"></i>
        </a>

        {{-- Delete Button --}}
        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="btn btn-sm btn-outline-danger" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    title="Delete Role"
                    onclick="return confirm('Are you sure you want to delete this role?');">
                <i class="bi bi-trash"></i>
            </button>
        </form>

    </div>
</td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No roles found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#rolesTable').DataTable({
            responsive: true,
            pageLength: 10,
            order: [[0, 'asc']],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search roles..."
            }
        });
    });
</script>
@endpush
@endsection
