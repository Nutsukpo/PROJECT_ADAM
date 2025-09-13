@extends('layout.master')

@section('title', 'Edit Employee')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-info">Edit Employee: {{ $employee->firstname }} {{ $employee->lastname }}</h6>
            <div>
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary mr-2">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
                <button type="submit" form="employeeForm" class="btn btn-sm btn-info">
                    <i class="fas fa-save"></i> Update Employee
                </button>
            </div>
        </div>
        <div class="card-body">
            <form id="employeeForm" action="/employees/{{$employee->id}}/update" method="POST" class="needs-validation" novalidate>
                @csrf
                
                <!-- Personal Information Section -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="section-header">
                            <h5 class="text-info"><i class="fas fa-user"></i> Personal Information</h5>
                            <hr class="divider">
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="firstname" class="form-label">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('firstname') is-invalid @enderror" 
                               id="firstname" name="firstname" placeholder="Enter first name" 
                               value="{{ old('firstname', $employee->firstname) }}" required>
                        @error('firstname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="lastname" class="form-label">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('lastname') is-invalid @enderror" 
                               id="lastname" name="lastname" placeholder="Enter last name" 
                               value="{{ old('lastname', $employee->lastname) }}" required>
                        @error('lastname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Employee Details Section -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="section-header">
                            <h5 class="text-info"><i class="fas fa-id-card"></i> Staff Details</h5>
                            <hr class="divider">
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="employee_id" class="form-label">Staff ID</label>
                        <input type="text" class="form-control bg-light" id="employee_id" name="employee_id" 
                               value="{{ old('employee_id', $employee->employee_id) }}" readonly>
                        <div class="form-text">System generated ID</div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="department" class="form-label">Department <span class="text-danger">*</span></label>
                        <select class="form-select @error('department') is-invalid @enderror" 
                                id="department" name="department" required>
                            <option value="">Select Department</option>
                            <option value="Administration" {{ old('department', $employee->department) == 'Administration' ? 'selected' : '' }}>Administration</option>
                            <option value="Mis" {{ old('department', $employee->department) == 'Mis' ? 'selected' : '' }}>Mis</option>
                            <option value="Engineering" {{ old('department', $employee->department) == 'Engineering' ? 'selected' : '' }}>Engineering</option>
                            <option value="Accounting" {{ old('department', $employee->department) == 'Accounting' ? 'selected' : '' }}>Accounting</option>
                            <option value="Ess" {{ old('department', $employee->department) == 'Ess' ? 'selected' : '' }}>Ess</option>
                            <option value="Led" {{ old('department', $employee->department) == 'Led' ? 'selected' : '' }}>Led</option>
                            
                        </select>
                        @error('department')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="position" class="form-label">Position <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('position') is-invalid @enderror" 
                               id="position" name="position" placeholder="Enter position" 
                               value="{{ old('position', $employee->position) }}" required>
                        @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Contact Information Section -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="section-header">
                            <h5 class="text-info"><i class="fas fa-address-book"></i> Contact Information</h5>
                            <hr class="divider">
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" placeholder="Enter email address" 
                               value="{{ old('email', $employee->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="contact" class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control @error('contact') is-invalid @enderror" 
                               id="contact" name="contact" placeholder="Enter phone number" 
                               value="{{ old('contact', $employee->contact) }}" required>
                        @error('contact')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" 
                               id="address" name="address" placeholder="Enter full address" 
                               value="{{ old('address', $employee->address) }}" required>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
// Client-side validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var form = document.getElementById('employeeForm');
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    }, false);
})();

// Phone number formatting (optional)
document.getElementById('contact').addEventListener('input', function(e) {
    var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
    e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
});
</script>
@endsection

<style>
    .divider {
        border: 0;
        height: 1px;
        background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
        margin: 10px 0;
    }
    .section-header {
        margin-bottom: 20px;
    }
    .form-label {
        font-weight: 600;
    }
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .bg-light {
        background-color: #f8f9fa!important;
    }
</style>
@endsection