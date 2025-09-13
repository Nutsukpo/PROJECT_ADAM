@extends('layout.master')

@section('title', 'Add New Employee')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-info">Add New Staff</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Personal Information Section -->
                <div class="form-section mb-4">
                    <h6 class="text-dark mb-3 border-bottom pb-2">Personal Information</h6>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstname">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror" 
                                   id="firstname" name="firstname" placeholder="Enter first name" 
                                   value="{{ old('firstname') }}" required>
                            @error('firstname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastname">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror" 
                                   id="lastname" name="lastname" placeholder="Enter last name" 
                                   value="{{ old('lastname') }}" required>
                            @error('lastname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Employment Information Section -->
                <div class="form-section mb-4">
                    <h6 class="text-dark mb-3 border-bottom pb-2">Employment Information</h6>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="employee_id">Staff ID</label>
                            <input type="text" class="form-control @error('employee_id') is-invalid @enderror" 
                                   id="employee_id" name="employee_id" placeholder="Auto-generated" 
                                   value="{{ old('employee_id') ?? 'EMP-' . strtoupper(Str::random(6)) }}" readonly>
                            @error('employee_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="department">Department <span class="text-danger">*</span></label>
                            <select class="form-control @error('department') is-invalid @enderror" 
                                    id="department" name="department" required>
                                <option value="">Select Department</option>
                                <option value="engineering" {{ old('department') == 'engineering' ? 'selected' : '' }}>Engineering</option>
                                <option value="administration" {{ old('department') == 'administration' ? 'selected' : '' }}>Administration</option>
                                <option value="accounting" {{ old('department') == 'accounting' ? 'selected' : '' }}>Accounting</option>
                                <option value="mis" {{ old('department') == 'mis' ? 'selected' : '' }}>MIS</option>
                                <option value="led" {{ old('department') == 'led' ? 'selected' : '' }}>LED</option>
                                <option value="ess" {{ old('department') == 'ess' ? 'selected' : '' }}>ESS</option>
                                <option value="transport" {{ old('department') == 'transport' ? 'selected' : '' }}>Transport</option>
                            </select>
                            @error('department')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="position">Position <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('position') is-invalid @enderror" 
                                   id="position" name="position" placeholder="Enter position" 
                                   value="{{ old('position') }}" required>
                            @error('position')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="form-section mb-4">
                    <h6 class="text-dark mb-3 border-bottom pb-2">Contact Information</h6>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" placeholder="Enter email" 
                                   value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="contact">Phone Number <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control @error('contact') is-invalid @enderror" 
                                   id="contact" name="contact" placeholder="Enter phone number" 
                                   value="{{ old('contact') }}" required>
                            @error('contact')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" 
                               id="address" name="address" placeholder="Enter address" 
                               value="{{ old('address') }}" required>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Profile Picture Section -->
                <div class="form-section mb-4">
                    <h6 class="text-dark mb-3 border-bottom pb-2">Profile Picture</h6>
                    <div class="form-group">
                        <label for="picture">Upload Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('picture') is-invalid @enderror" 
                                   id="picture" name="picture" accept="image/*">
                            <label class="custom-file-label" for="picture">Choose file</label>
                            @error('picture')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Maximum file size: 2MB. Accepted formats: JPG, PNG, GIF.
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-group row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-save mr-2"></i> Save Staff
                        </button>
                        <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times mr-2"></i> Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Update file input label with selected filename
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = e.target.files[0] ? e.target.files[0].name : "Choose file";
        e.target.nextElementSibling.textContent = fileName;
    });

    // Auto-generate employee ID if empty
    document.getElementById('employee_id').addEventListener('focus', function() {
        if (!this.value) {
            this.value = 'EMP-' + Math.random().toString(36).substr(2, 6).toUpperCase();
        }
    });
</script>
@endsection

@section('styles')
<style>
    .form-section {
        background-color: #f8f9fa;
        padding: 1.5rem;
        border-radius: 0.35rem;
        margin-bottom: 1.5rem;
    }
    .custom-file-label::after {
        content: "Browse";
    }
</style>
@endsection