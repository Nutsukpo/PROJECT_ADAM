@extends('layout.master')

@section('title', 'Add Incoming Letter')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-dark">Add Incoming Letter</h6>
            <a href="{{ route('incomingletters.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
        <div class="card-body">
        <form id="incomingLetterForm" action="{{ route('incomingletters.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf           
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="section-header">
                            <h5 class="text-info"><i class="fas fa-envelope"></i> Letter Information</h5>
                            <hr class="divider">
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="letter_id" class="form-label">Letter ID</label>
                        <input type="text" class="form-control bg-light" id="letter_id" name="letter_id" 
                               value="{{ old('letter_id') }}" readonly>
                        <div class="form-text">System generated ID</div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="reference_no" class="form-label">Reference No <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('reference_no') is-invalid @enderror" 
                               id="reference_no" name="reference_no" placeholder="Enter reference number" 
                               value="{{ old('reference_no') }}" required>
                        @error('reference_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="to_whom_received" class="form-label">To Whom Received <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('to_whom_received') is-invalid @enderror" 
                               id="to_whom_received" name="to_whom_received" placeholder="Enter recipient name" 
                               value="{{ old('to_whom_received') }}" required>
                        @error('to_whom_received')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="date_of_letter" class="form-label">Date of Letter <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('date_of_letter') is-invalid @enderror" 
                               id="date_of_letter" name="date_of_letter" value="{{ old('date_of_letter') }}" required>
                        @error('date_of_letter')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="sender" class="form-label">Sender <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('sender') is-invalid @enderror" 
                               id="sender" name="sender" placeholder="Enter sender name" 
                               value="{{ old('sender') }}" required>
                        @error('sender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="mode_of_letter" class="form-label">Mode of Letter <span class="text-danger">*</span></label>
                        <select class="form-select @error('mode_of_letter') is-invalid @enderror" 
                                id="mode_of_letter" name="mode_of_letter" required>
                            <option value="">Select Mode</option>
                            <option value="Email" {{ old('mode_of_letter') == 'Email' ? 'selected' : '' }}>Email</option>
                            <option value="Post" {{ old('mode_of_letter') == 'Post' ? 'selected' : '' }}>Post</option>
                            <option value="Courier" {{ old('mode_of_letter') == 'Courier' ? 'selected' : '' }}>Courier</option>
                            <option value="Hand Delivery" {{ old('mode_of_letter') == 'Hand Delivery' ? 'selected' : '' }}>Hand Delivery</option>
                        </select>
                        @error('mode_of_letter')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="organization_name" class="form-label">Organization Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('organization_name') is-invalid @enderror" 
                               id="organization_name" name="organization_name" placeholder="Enter organization name" 
                               value="{{ old('organization_name') }}" required>
                        @error('organization_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="name_of_person_receiving" class="form-label">Person Receiving <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name_of_person_receiving') is-invalid @enderror" 
                               id="name_of_person_receiving" name="name_of_person_receiving" 
                               placeholder="Enter receiver name" value="{{ old('name_of_person_receiving') }}" required>
                        @error('name_of_person_receiving')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="receiving_date" class="form-label">Receiving Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('receiving_date') is-invalid @enderror" 
                               id="receiving_date" name="receiving_date" value="{{ old('receiving_date') }}" required>
                        @error('receiving_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="file_path" class="form-label">Upload Letter Document <span class="text-danger">*</span></label>
                        <input type="file" class="form-control @error('file_path') is-invalid @enderror" 
                               id="file_path" name="file_path" accept=".pdf,.doc,.docx,.jpg,.png" required>
                        <div class="form-text">Accepted formats: PDF, DOC, DOCX, JPG, PNG</div>
                        @error('file_path')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="reset" class="btn btn-secondary mr-2">
                            <i class="fas fa-redo"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-save"></i> Save Letter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Client-side validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var form = document.getElementById('incomingLetterForm');
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    }, false);
})();
</script>
@endsection