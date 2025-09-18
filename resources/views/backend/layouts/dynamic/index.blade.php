@extends('backend.master')

@section('title', 'All Dynamic Pages')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-3 w-100">

                {{-- Header --}}
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
    <h5 class="mb-0 fw-bold text-white">
        <i class="bi bi-files me-2"></i> All Dynamic Pages
    </h5>
    <a href="{{ route('dynamic.create') }}" class="btn btn-light btn-sm">
        <i class="bi bi-plus-circle me-1"></i> Add New Page
    </a>
</div>


                {{-- Success Message --}}
                @if(session('success'))
                    <div class="alert alert-success m-3">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Table --}}
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dynamicPagesTable" class="table table-bordered table-hover align-middle mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Created At</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pages as $page)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $page->title }}</td>
                                        <td>{{ $page->slug }}</td>
                                        <td>{{ $page->created_at->format('Y-m-d') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('dynamic.show', $page->id) }}" class="btn btn-sm btn-info me-1"><i class="bi bi-eye"></i></a>
                                            <a href="{{ route('dynamic.edit', $page->id) }}" class="btn btn-sm btn-warning me-1">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('dynamic.destroy', $page->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No pages found.</td>
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

<style>
/* Ensure the card stretches to the sidebar */
.container-fluid {
    padding-left: 20px;
    padding-right: 20px;
}

/* Adjust page-wrapper for sidebar */
.page-wrapper {
    margin-left: 190px; /* full sidebar width */
    padding: 60px;
}

.navbar-vertical.collapsed + .page-wrapper,
.sidebar.collapsed + .page-wrapper {
    margin-left: 80px;
}

@media (max-width: 992px) {
    .page-wrapper {
        margin-left: 0 !important;
        padding: 15px;
    }
}
</style>

@push('scripts')
    <!-- DataTables CSS & JS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#dynamicPagesTable').DataTable({
                responsive: true,
                pageLength: 5,
                order: [[0, 'asc']],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search pages..."
                }
            });
        });
    </script>
@endpush
@endsection
