@extends('layout.master')

@section('title', 'Add Outgoing Letter')

@section('content')
<div class="container-fluid px-4">
    <div class="card shadow border-0 rounded-lg mt-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 text-primary">
                <i class="fas fa-paper-plane me-2"></i>Create New Outgoing Letter
            </h5>
            <a href="{{ route('outgoingletters.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
        </div>
        <div class="card-body">
            <form id="outgoingLetterForm" action="{{ route('outgoingletters.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                
                <!-- Letter Information Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="section-title mb-4">
                            <h6 class="text-primary fw-bold">
                                <i class="fas fa-envelope-open-text me-2"></i>Letter Details
                            </h6>
                            <hr class="mt-1">
                        </div>
                    </div>
                    
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- Letter ID -->
                        <div class="mb-3">
                            <label for="letter_id" class="form-label small">Letter ID</label>
                            <input type="text" class="form-control bg-light" id="letter_id" name="letter_id" 
                                   value="{{ old('letter_id') ?? 'OL-' . time() }}" readonly>
                            <div class="form-text text-muted small">Automatically generated</div>
                        </div>
                        
                        <!-- Reference No -->
                        <div class="mb-3">
                            <label for="reference_no" class="form-label small">Reference No <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('reference_no') is-invalid @enderror" 
                                   id="reference_no" name="reference_no" placeholder="E.g., REF/2023/001" 
                                   value="{{ old('reference_no') }}" required>
                            @error('reference_no')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Organization Name -->
                        <div class="mb-3">
                            <label for="organization_name" class="form-label small">Recipient Organization <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('organization_name') is-invalid @enderror" 
                                   id="organization_name" name="organization_name" placeholder="Enter organization name" 
                                   value="{{ old('organization_name') }}" required>
                            @error('organization_name')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Sending Date -->
                        <div class="mb-3">
                            <label for="sending_date" class="form-label small">Sending Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('sending_date') is-invalid @enderror" 
                                   id="sending_date" name="sending_date" value="{{ old('sending_date') }}" required>
                            @error('sending_date')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label small">Subject/Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3" 
                                      placeholder="Brief description of the letter content" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Full Width Row -->
                    <div class="col-12">
                        <!-- File Upload -->
                        <div class="mb-3">
                            <label for="file_path" class="form-label small">Attach Document <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="file" class="form-control @error('file_path') is-invalid @enderror" 
                                       id="file_path" name="file_path" accept=".pdf,.doc,.docx" required>
                                <button class="btn btn-outline-secondary" type="button" id="clearFile">
                                    <i class="fas fa-times"></i>
                                </button>
                                @error('file_path')
                                    <div class="invalid-feedback small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-text text-muted small">Accepted formats: PDF, DOC, DOCX (Max: 5MB)</div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="reset" class="btn btn-outline-secondary">
                        <i class="fas fa-undo me-1"></i> Reset Form
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save Letter
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Enhanced Form Validation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('outgoingLetterForm');
    
    // Bootstrap validation
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    }, false);
    
    // Clear file input
    document.getElementById('clearFile').addEventListener('click', function() {
        document.getElementById('file_path').value = '';
    });
    
    // Auto-generate reference number if empty
    const refNoInput = document.getElementById('reference_no');
    if (!refNoInput.value) {
        const today = new Date();
        refNoInput.value = `REF/${today.getFullYear()}/${String(today.getMonth() + 1).padStart(2, '0')}/`;
    }
});
</script>
@endsection