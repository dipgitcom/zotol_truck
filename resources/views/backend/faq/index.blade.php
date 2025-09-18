@extends('backend.master')

@section('title', 'FAQ Management')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <!-- Card -->
            <div class="card shadow-sm border-0 rounded-3">
                <!-- Header -->
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-white">
                        <i class="bi bi-question-circle me-2"></i> Frequently Asked Questions
                    </h5>
                    <a href="{{ route('faq.create') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Add New FAQ
                    </a>
                </div>

                <!-- Body -->
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($faqs->count())
                        <div class="accordion" id="faqAccordion">
                            @foreach($faqs as $faq)
                                <div class="accordion-item mb-2 shadow-sm rounded">
                                    <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                        <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            {!! $faq->answer !!}
                                            <div class="mt-3 d-flex gap-2">
                                                <a href="{{ route('faq.edit', $faq->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                                </a>
                                                <form action="{{ route('faq.destroy', $faq->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                        <i class="bi bi-trash me-1"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center">No FAQs found. Click "Add New FAQ" to create one.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Optional: smooth accordion transitions
    const accordionEl = document.getElementById('faqAccordion');
    if(accordionEl) {
        const bsAccordion = new bootstrap.Accordion(accordionEl);
    }
</script>
@endpush
