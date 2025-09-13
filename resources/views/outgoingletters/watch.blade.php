@extends('layout.master')

@section('title', 'View Outgoing Letter')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Outgoing Letter Details</h1>
        <a href="{{ route('outgoingletters.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>

    <div class="row">
        <!-- Letter Information -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3" style="background-color: cadetblue;">
                    <h6 class="m-0 font-weight-bold text-white" >Letter Information</h6>
                </div>
                <div class="card-body">
                    <div class="info-item">
                        <span class="text-info">Letter ID:</span>
                        <span class="info-value">{{ $outgoingletters->letter_id }}</span>
                    </div>
                    <div class="info-item">
                        <span class="text-info">Reference No:</span>
                        <span class="info-value">{{ $outgoingletters->reference_no }}</span>
                    </div>
                    <div class="info-item">
                        <span class="text-info">Organization Name:</span>
                        <span class="info-value">{{ $outgoingletters->organization_name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="text-info">Sending Date:</span>
                        <span class="info-value">{{ date('F j, Y', strtotime($outgoingletters->sending_date)) }}</span>
                    </div>
                    <div class="info-item">
                        <span class="text-info">Description:</span>
                        <p class="info-value description-text">{{ $outgoingletters->description }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Document Viewer -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 " style="background-color: cadetblue;">
                    <h6 class="m-0 font-weight-bold text-white">Letter Document</h6>
                </div>
                <div class="card-body text-center">
                    @if($outgoingletters->file_path)
                        <div class="document-container mb-4">
                            @if(pathinfo($outgoingletters->file_path, PATHINFO_EXTENSION) === 'pdf')
                                <embed src="{{ asset('storage/' . $outgoingletters->file_path) }}" 
                                       type="application/pdf" 
                                       width="100%" 
                                       height="500px"
                                       class="document-viewer shadow">
                            @else
                                <div class="alert alert-info">
                                    <i class="fas fa-file-word fa-3x mb-3"></i>
                                    <p>This document format cannot be previewed. Please download to view.</p>
                                </div>
                            @endif
                        </div>
                        <a href="{{ asset('storage/' . $outgoingletters->file_path) }}" 
                           download 
                           class="btn btn-info">
                            <i class="fas fa-download"></i> Download Document
                        </a>
                    @else
                        <div class="alert alert-warning">No document attached to this letter</div>
                    @endif
                </div>
            </div>
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
    
    .text-info {
        font-weight: 600;
        color: #4e73df;
        display: inline-block;
        min-width: 160px;
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
    
    .document-container {
        border: 1px solid #e3e6f0;
        border-radius: 0.35rem;
        overflow: hidden;
    }
    
    .document-viewer {
        border: none;
    }
    
    .card-header.bg-info {
        background-color: #4e73df !important;
    }
</style>
@endsection