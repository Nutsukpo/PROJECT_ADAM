@extends('layout.master')

@section('title', 'Edit Asset')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-info">Edit Asset: {{ $asset->asset_name }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('assets.update', $asset->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Asset Information Section -->
                <div class="form-section mb-4">
                    <h6 class="text-dark mb-3 border-bottom pb-2">Asset Information</h6>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="asset_id">Asset ID</label>
                            <input type="text" class="form-control @error('asset_id') is-invalid @enderror" 
                                   id="asset_id" name="asset_id" value="{{ old('asset_id', $asset->asset_id) }}" readonly>
                            @error('asset_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="asset_name">Asset Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('asset_name') is-invalid @enderror" 
                                   id="asset_name" name="asset_name" placeholder="Enter asset name" 
                                   value="{{ old('asset_name', $asset->asset_name) }}" required>
                            @error('asset_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Asset Details Section -->
                <div class="form-section mb-4">
                    <h6 class="text-dark mb-3 border-bottom pb-2">Asset Details</h6>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="department_for">Department <span class="text-danger">*</span></label>
                            <select class="form-control @error('department_for') is-invalid @enderror" 
                                    id="department_for" name="department_for" required>
                                <option value="">Select Department</option>
                                <option value="engineering" {{ old('department_for', $asset->department_for) == 'engineering' ? 'selected' : '' }}>Engineering</option>
                                <option value="administration" {{ old('department_for', $asset->department_for) == 'administration' ? 'selected' : '' }}>Administration</option>
                                <option value="accounting" {{ old('department_for', $asset->department_for) == 'accounting' ? 'selected' : '' }}>Accounting</option>
                                <option value="mis" {{ old('department_for', $asset->department_for) == 'mis' ? 'selected' : '' }}>MIS</option>
                                <option value="led" {{ old('department_for', $asset->department_for) == 'led' ? 'selected' : '' }}>LED</option>
                                <option value="ess" {{ old('department_for', $asset->department_for) == 'ess' ? 'selected' : '' }}>ESS</option>
                                <option value="transport" {{ old('department_for', $asset->department_for) == 'transport' ? 'selected' : '' }}>Transport</option>
                            </select>
                            @error('department_for')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="asset_type">Asset Type <span class="text-danger">*</span></label>
                            <select class="form-control @error('asset_type') is-invalid @enderror" 
                                    id="asset_type" name="asset_type" required>
                                <option value="">Select Type</option>
                                <option value="equipment" {{ old('asset_type', $asset->asset_type) == 'equipment' ? 'selected' : '' }}>Equipment</option>
                                <option value="furniture" {{ old('asset_type', $asset->asset_type) == 'furniture' ? 'selected' : '' }}>Furniture</option>
                                <option value="vehicle" {{ old('asset_type', $asset->asset_type) == 'vehicle' ? 'selected' : '' }}>Vehicle</option>
                                <option value="electronics" {{ old('asset_type', $asset->asset_type) == 'electronics' ? 'selected' : '' }}>Electronics</option>
                                <option value="software" {{ old('asset_type', $asset->asset_type) == 'software' ? 'selected' : '' }}>Software</option>
                            </select>
                            @error('asset_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Identification Section -->
                <div class="form-section mb-4">
                    <h6 class="text-dark mb-3 border-bottom pb-2">Identification</h6>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="serial_number">Serial Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('serial_number') is-invalid @enderror" 
                                   id="serial_number" name="serial_number" placeholder="Enter serial number" 
                                   value="{{ old('serial_number', $asset->serial_number) }}" required>
                            @error('serial_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="asset_cost">Asset Cost <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" step="0.01" class="form-control @error('asset_cost') is-invalid @enderror" 
                                       id="asset_cost" name="asset_cost" placeholder="0.00" 
                                       value="{{ old('asset_cost', $asset->asset_cost) }}" required>
                                @error('asset_cost')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-group row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-save mr-2"></i> Update Asset
                        </button>
                        <a href="{{ route('assets.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times mr-2"></i> Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .form-section {
        background-color: #f8f9fa;
        padding: 1.5rem;
        border-radius: 0.35rem;
        margin-bottom: 1.5rem;
    }
</style>
@endsection