@extends('backend.master')

@section('title','Add FAQ')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <!-- Card -->
            <div class="card shadow-sm border-0 rounded-3">
                <!-- Header -->
               <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-white">
                        <i class="bi bi-plus-circle me-2"></i> Add New FAQ
                    </h5>
                    <a href="{{ route('faq.index') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left-circle me-1"></i> Back to List
                    </a>
                </div>

                <!-- Body -->
                <div class="card-body">
                    <form action="{{ route('faq.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Question <span class="text-danger">*</span></label>
                            <input type="text" name="question" class="form-control form-control-lg" placeholder="Enter the question" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Answer <span class="text-danger">*</span></label>
                            <textarea name="answer" class="form-control form-control-lg" rows="6" placeholder="Enter the answer" required></textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('faq.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Save FAQ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
