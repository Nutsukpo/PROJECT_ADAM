@extends('layout.master')

@section('title', 'Edit Outgoing Letter')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-dark">Edit Outgoing Letter: {{ $outgoingletters->letter_id }}</h6>
            <a href="{{ route('outgoingletters.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
        <div class="card-body">
            <form id="editLetterForm" action="/outgoingletters/{{$outgoingletters->id}}/update" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="section-header">
                            <h5 class="text-info"><i class="fas fa-edit"></i> Letter Details</h5>
                            <hr class="divider">
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="letter_id" class="form-label">Letter ID</label>
                        <input type="text" class="form-control bg-light" id="letter_id" name="letter_id" 
                               value="{{ $outgoingletters->letter_id }}" readonly>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="reference_no" class="form-label">Reference No</label>
                        <input type="text" class="form-control @error('reference_no') is-invalid @enderror" 
                               id="reference_no" name="reference_no" value="{{ $outgoingletters->reference_no }}">
                        @error('reference_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="organization_name" class="form-label">Organization Name</label>
                        <input type="text" class="form-control @error('organization_name') is-invalid @enderror" 
                               id="organization_name" name="organization_name" value="{{ $outgoingletters->organization_name }}">
                        @error('organization_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="sending_date" class="form-label">Sending Date</label>
                        <input type="date" class="form-control @error('sending_date') is-invalid @enderror" 
                               id="sending_date" name="sending_date" value="{{ $outgoingletters->sending_date }}">
                        @error('sending_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3">{{ $outgoingletters->description }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="file_path" class="form-label">Current Document</label>
                        <div class="current-file">
                            @if($outgoingletters->file_path)
                                <a href="{{ asset('storage/' . $outgoingletters->file_path) }}" target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> View Current Document
                                </a>
                            @else
                                <span class="text-muted">No document uploaded</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="new_file_path" class="form-label">Update Document (Optional)</label>
                        <input type="file" class="form-control @error('file_path') is-invalid @enderror" 
                               id="new_file_path" name="file_path" accept=".pdf,.doc,.docx">
                        <div class="form-text">Leave blank to keep current document</div>
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
                            <i class="fas fa-save"></i> Update Letter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection