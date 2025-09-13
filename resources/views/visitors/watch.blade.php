@extends('layout.master')

@section('title', 'View Visitor')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-user-circle me-2"></i>Visitor Details
            </h5>
            <div>
                <a href="{{ route('visitors.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back to List
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="detail-item mb-3">
                        <label class="detail-label">Client Name:</label>
                        <div class="detail-value">{{ $visitor->visitor_name }}</div>
                    </div>
                    <div class="detail-item mb-3">
                        <label class="detail-label">Contact:</label>
                        <div class="detail-value">{{ $visitor->contact }}</div>
                    </div>
                    <div class="detail-item mb-3">
                        <label class="detail-label">Gender:</label>
                        <div class="detail-value">{{ $visitor->gender }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-item mb-3">
                        <label class="detail-label">Department:</label>
                        <div class="detail-value">{{ $visitor->department }}</div>
                    </div>
                    <div class="detail-item mb-3">
                        <label class="detail-label">Vulnerability:</label>
                        <div class="detail-value">{{ $visitor->vulnerability }}</div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="detail-item mb-3">
                        <label class="detail-label">Purpose of Visit:</label>
                        <div class="detail-value">{{ $visitor->purpose_of_visit }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-item mb-3">
                        <label class="detail-label">Visit Date:</label>
                        <div class="detail-value">
                            {{ \Carbon\Carbon::parse($visitor->visiting_date)->format('F j, Y') }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="detail-item mb-3">
                        <label class="detail-label">Arrival Time:</label>
                        <div class="detail-value">{{ $visitor->time_in }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-item mb-3">
                        <label class="detail-label">Departure Time:</label>
                        <div class="detail-value">{{ $visitor->time_out ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .detail-item {
        margin-bottom: 1rem;
    }
    .detail-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.25rem;
    }
    .detail-value {
        padding: 0.5rem;
        background-color: #f8f9fa;
        border-radius: 0.25rem;
    }
</style>
@endsection