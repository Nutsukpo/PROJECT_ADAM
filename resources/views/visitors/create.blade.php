@extends('layout.master')

@section('title', 'Add Visitor')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 text-dark">
                <i class="fas fa-user-plus me-2"></i>Register New Visitor
            </h5>
        </div>
        <div class="card-body">
            <form class="visitor-form" action="{{ route('visitors.store') }}" method="POST">
                @csrf
                
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Client Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('visitor_name') is-invalid @enderror"
                               placeholder="Enter client name" name="visitor_name" required 
                               value="{{ old('visitor_name') }}">
                        @error('visitor_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Agenda <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('purpose_of_visit') is-invalid @enderror" 
                               placeholder="Purpose of visit" name="purpose_of_visit" required 
                               value="{{ old('purpose_of_visit') }}">
                        @error('purpose_of_visit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Contact <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('contact') is-invalid @enderror" 
                               placeholder="Enter contact number" name="contact" required 
                               value="{{ old('contact') }}">
                        @error('contact')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Department <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('department') is-invalid @enderror" 
                               placeholder="Enter department" name="department" required 
                               value="{{ old('department') }}">
                        @error('department')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Gender</label>
                        <select class="form-select @error('gender') is-invalid @enderror" name="gender">
                            <option value="">Select gender</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Vulnerability <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('vulnerability') is-invalid @enderror" 
                               placeholder="Enter vulnerability status" name="vulnerability" required 
                               value="{{ old('vulnerability') }}">
                        @error('vulnerability')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Arrival Time <span class="text-danger">*</span></label>
                        <input type="time" class="form-control @error('time_in') is-invalid @enderror" 
                               name="time_in" required value="{{ old('time_in') }}">
                        @error('time_in')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Departure Time</label>
                        <input type="time" class="form-control @error('time_out') is-invalid @enderror" 
                               name="time_out" value="{{ old('time_out') }}">
                        @error('time_out')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Visit Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('visiting_date') is-invalid @enderror" 
                               name="visiting_date" required value="{{ old('visiting_date') }}">
                        @error('visiting_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="reset" class="btn btn-secondary me-md-2">
                        <i class="fas fa-undo me-1"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-save me-1"></i> Save Visitor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .visitor-form {
        max-width: 900px;
        margin: 0 auto;
    }
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,.125);
    }
</style>
@endsection