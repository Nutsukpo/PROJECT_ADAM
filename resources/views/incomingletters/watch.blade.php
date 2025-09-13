@extends('layout.master')

@section('title', 'View Incoming Letter')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Incoming Letter Details</h1>
        <a href="{{ url()->previous() }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Letters
        </a>
    </div>

    <!-- Letter Details Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: cadetblue;">
            <h6 class="m-0 font-weight-bold text-white">Letter Information</h6>
        </div>
        <div class="card-body">
            <div class="row mb-4 ">
                <!-- Basic Information -->
                <div class="col-md-6">
                    <div class="info-item">
                        <span class="info-label text-dark" >LETTER ID:</span>
                        <span class="info-value">{{ $incomingletters->letter_id }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label text-dark">REFERENCE NO:</span>
                        <span class="info-value">{{ $incomingletters->reference_no }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label text-dark">DATE OF LETTER:</span>
                        <span class="info-value">{{ $incomingletters->date_of_letter }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label text-dark">RECEIVING DATE:</span>
                        <span class="info-value">{{ $incomingletters->receiving_date }}</span>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="info-item">
                        <span class="info-label text-dark">TO WHOM RECEIVED:</span>
                        <span class="info-value">{{ $incomingletters->to_whom_received }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label text-dark">SENDER:</span>
                        <span class="info-value">{{ $incomingletters->sender }}</span>
                    </div>
                    <div class="info-item text-dark">
                        <span class="info-label text-dark">ORGANIZATION NAME:</span>
                        <span class="info-value">{{ $incomingletters->organization_name }}</span>
                    </div>
                    <div class="info-item text-dark">
                        <span class="info-label text-dark">NAME OF PERSON RECEIVING:</span>
                        <span class="info-value">{{ $incomingletters->name_of_person_receiving }}</span>
                    </div>
                </div>
            </div>

            <!-- Additional Details -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="info-item">
                        <span class="info-label text-dark">MODE OF LETTER:</span>
                        <span class="info-value">{{ $incomingletters->mode_of_letter }}</span>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="row">
                <div class="col-md-12">
                    <div class="info-item">
                        <span class="info-label text-dark">DESCRIPTION:</span>
                        <p class="info-value description-text">{{ $incomingletters->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PDF Viewer Card -->
    <div class="card shadow mb-4 text-dark  ">
        <div class="card-header py-3" style="background-color: cadetblue;">
            <h6 class="m-0 font-weight-bold text-white" >Letter Attachment</h6>
        </div>
        <div class="card-body text-center">
            @if($incomingletters->file_path)
                <div class="pdf-container mb-4">
                    <embed src="{{ asset('storage/' . $incomingletters->file_path) }}" 
                           type="application/pdf" 
                           width="100%" 
                           height="600px"
                           class="pdf-viewer shadow">
                </div>
                <a href="{{ asset('storage/' . $incomingletters->file_path) }}" 
                   target="_blank" 
                   class="btn btn-info">
                    <i class="fas fa-download"></i> Download PDF
                </a>
            @else
                <div class="alert alert-warning">No attachment available for this letter</div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .info-item {
        margin-bottom: 1.2rem;
        padding-bottom: 0.8rem;
        border-bottom: 1px solid #eee;
    }
    
    .info-label {
        font-weight: 600;
        color: #4e73df;
        display: inline-block;
        min-width: 220px;
    }
    
    .info-value {
        color: #5a5c69;
    }
    
    .description-text {
        white-space: pre-wrap;
        background-color: #f8f9fc;
        padding: 15px;
        border-radius: 5px;
        border-left: 3px solid #4e73df;
    }
    
    .pdf-container {
        border: 1px solid #e3e6f0;
        border-radius: 0.35rem;
        overflow: hidden;
    }
    
    .pdf-viewer {
        border: none;
    }
    
    .card-header.bg-primary {
        background-color: #4e73df !important;
    }
</style>
@endsection