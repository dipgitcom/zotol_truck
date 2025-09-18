@extends('backend.master')

@section('title', 'Categories List')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fe-bold text-white">Categories List</h5>
                    <a href="{{ route('categories.create') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-plus-circle"></i> Add Category
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="categoryTable" class="table table-striped table-bordered dt-responsive nowrap w-100 align-middle">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    var table = $('#categoryTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
        dom: '<"d-flex justify-content-between mb-3"<"me-3"l><"ms-auto"f>B>rtip',
        buttons: [
            { extend: 'copy', className: 'btn btn-sm btn-secondary me-1' },
            { extend: 'excel', className: 'btn btn-sm btn-success me-1' },
            { extend: 'csv', className: 'btn btn-sm btn-info me-1' },
            { extend: 'pdf', className: 'btn btn-sm btn-danger me-1' },
            { extend: 'print', className: 'btn btn-sm btn-primary' }
        ],
        ajax: "{{ route('categories.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center' },
            { data: 'name', name: 'name' },
            { data: 'slug', name: 'slug' },
            { data: 'image', name: 'image', orderable: false, searchable: false, className: 'text-center' },
            { data: 'status', name: 'status', orderable: false, searchable: false, className: 'text-center' },
            { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' },
        ],
        order: [[1, 'asc']],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search categories...",
            lengthMenu: "Show _MENU_ entries"
        },
        initComplete: function() {
            // Style search box
            $('#categoryTable_filter input').addClass('form-control form-control-sm rounded shadow-sm').css('width', '250px');

            // Style length dropdown
            $('#categoryTable_length select').addClass('form-select form-select-sm rounded shadow-sm').css('width', '80px');
        },
        createdRow: function(row, data, dataIndex) {
            $(row).addClass('align-middle');
            $(row).hover(
                function() { $(this).addClass('shadow-sm'); },
                function() { $(this).removeClass('shadow-sm'); }
            );
        },
        
    });

    // Move buttons container
    table.buttons().container().appendTo('#categoryTable_wrapper .col-md-6:eq(0)');
});
</script>
@endpush
