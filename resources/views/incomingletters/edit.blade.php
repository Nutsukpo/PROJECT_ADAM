@extends('layout.master')

@section('title', 'Edit Incoming Letter')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-info">Edit Incoming Letter: {{ $incomingletters->letter_id }}</h6>
            <a href="{{ route('incomingletters.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
        <div class="card-body">
            <form id="editLetterForm" action="/incomingletters/{{$incomingletters->id}}/update" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
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
                               value="{{ $incomingletters->letter_id }}" readonly>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="reference_no" class="form-label">Reference No</label>
                        <input type="text" class="form-control @error('reference_no') is-invalid @enderror" 
                               id="reference_no" name="reference_no" value="{{ $incomingletters->reference_no }}">
                        @error('reference_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="to_whom_received" class="form-label">To Whom Received</label>
                        <input type="text" class="form-control @error('to_whom_received') is-invalid @enderror" 
                               id="to_whom_received" name="to_whom_received" value="{{ $incomingletters->to_whom_received }}">
                        @error('to_whom_received')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="date_of_letter" class="form-label">Date of Letter</label>
                        <input type="date" class="form-control @error('date_of_letter') is-invalid @enderror" 
                               id="date_of_letter" name="date_of_letter" value="{{ $incomingletters->date_of_letter }}">
                        @error('date_of_letter')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="sender" class="form-label">Sender</label>
                        <input type="text" class="form-control @error('sender') is-invalid @enderror" 
                               id="sender" name="sender" value="{{ $incomingletters->sender }}">
                        @error('sender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="mode_of_letter" class="form-label">Mode of Letter</label>
                        <select class="form-select @error('mode_of_letter') is-invalid @enderror" 
                                id="mode_of_letter" name="mode_of_letter">
                            <option value="Email" {{ $incomingletters->mode_of_letter == 'Email' ? 'selected' : '' }}>Email</option>
                            <option value="Post" {{ $incomingletters->mode_of_letter == 'Post' ? 'selected' : '' }}>Post</option>
                            <option value="Courier" {{ $incomingletters->mode_of_letter == 'Courier' ? 'selected' : '' }}>Courier</option>
                            <option value="Hand Delivery" {{ $incomingletters->mode_of_letter == 'Hand Delivery' ? 'selected' : '' }}>Hand Delivery</option>
                        </select>
                        @error('mode_of_letter')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="organization_name" class="form-label">Organization Name</label>
                        <input type="text" class="form-control @error('organization_name') is-invalid @enderror" 
                               id="organization_name" name="organization_name" value="{{ $incomingletters->organization_name }}">
                        @error('organization_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="name_of_person_receiving" class="form-label">Person Receiving</label>
                        <input type="text" class="form-control @error('name_of_person_receiving') is-invalid @enderror" 
                               id="name_of_person_receiving" name="name_of_person_receiving" 
                               value="{{ $incomingletters->name_of_person_receiving }}">
                        @error('name_of_person_receiving')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="receiving_date" class="form-label">Receiving Date</label>
                        <input type="date" class="form-control @error('receiving_date') is-invalid @enderror" 
                               id="receiving_date" name="receiving_date" value="{{ $incomingletters->receiving_date }}">
                        @error('receiving_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3">{{ $incomingletters->description }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="current_file" class="form-label">Current Document</label>
                        <div class="current-file">
                            @if($incomingletters->file_path)
                                <a href="{{ asset('storage/' . $incomingletters->file_path) }}" target="_blank" class="btn btn-sm btn-info">
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
                               id="new_file_path" name="file_path" accept=".pdf,.doc,.docx,.jpg,.png">
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