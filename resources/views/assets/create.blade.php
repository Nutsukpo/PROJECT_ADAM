@extends('layout.master')

@section('title', 'Add New Asset')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-info">Add New Asset</h6>
            <div>
                <a href="{{ route('assets.index') }}" class="btn btn-sm btn-secondary mr-2">
                    <i class="fas fa-arrow-left"></i> Back to Assets
                </a>
                <button type="submit" form="assetForm" class="btn btn-sm btn-info">
                    <i class="fas fa-save"></i> Save Asset
                </button>
            </div>
        </div>
        <div class="card-body">
            <form id="assetForm" action="{{ route('assets.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="section-header">
                            <h5 class="text-info"><i class="fas fa-info-circle"></i> Basic Information</h5>
                            <hr class="divider">
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="asset_id" class="form-label">Asset ID</label>
                        <input type="text" class="form-control bg-light" id="asset_id" name="asset_id" 
                               value="{{ old('asset_id') }}" readonly>
                        <div class="form-text">Automatically generated</div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="asset_name" class="form-label">Asset Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('asset_name') is-invalid @enderror" 
                               id="asset_name" name="asset_name" value="{{ old('asset_name') }}" required>
                        @error('asset_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="department_for" class="form-label">Department <span class="text-danger">*</span></label>
                        <select class="form-select @error('department_for') is-invalid @enderror" 
                                id="department_for" name="department_for" required>
                            <option value="" disabled selected>Select Department</option>
                            <option value="IT" {{ old('department_for') == 'IT' ? 'selected' : '' }}>IT</option>
                            <option value="Finance" {{ old('department_for') == 'Finance' ? 'selected' : '' }}>Finance</option>
                            <option value="Operations" {{ old('department_for') == 'Operations' ? 'selected' : '' }}>Operations</option>
                            <option value="HR" {{ old('department_for') == 'HR' ? 'selected' : '' }}>Human Resources</option>
                        </select>
                        @error('department_for')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="asset_type" class="form-label">Asset Type <span class="text-danger">*</span></label>
                        <select class="form-select @error('asset_type') is-invalid @enderror" 
                                id="asset_type" name="asset_type" required>
                            <option value="" disabled selected>Select Asset Type</option>
                            <option value="Equipment" {{ old('asset_type') == 'Equipment' ? 'selected' : '' }}>Equipment</option>
                            <option value="Vehicle" {{ old('asset_type') == 'Vehicle' ? 'selected' : '' }}>Vehicle</option>
                            <option value="Furniture" {{ old('asset_type') == 'Furniture' ? 'selected' : '' }}>Furniture</option>
                            <option value="Electronics" {{ old('asset_type') == 'Electronics' ? 'selected' : '' }}>Electronics</option>
                        </select>
                        @error('asset_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="section-header">
                            <h5 class="text-info"><i class="fas fa-barcode"></i> Identification Details</h5>
                            <hr class="divider">
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="serial_number" class="form-label">Serial Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('serial_number') is-invalid @enderror" 
                               id="serial_number" name="serial_number" value="{{ old('serial_number') }}" required>
                        @error('serial_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="asset_cost" class="form-label">Asset Cost (USD) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" class="form-control @error('asset_cost') is-invalid @enderror" 
                                   id="asset_cost" name="asset_cost" value="{{ old('asset_cost') }}" required>
                            @error('asset_cost')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
// Example client-side validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
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
</style>
@endsection