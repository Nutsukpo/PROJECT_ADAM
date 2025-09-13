@extends('layout.master')

@section('title', 'Memo Approvals')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Memo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary-color: #5F9EA0;
            --secondary-color: #6c757d;
            --success-color: #1cbb8c;
            --danger-color: #fc5b69;
            --warning-color: #f7b84b;
            --info-color: #5ac1dd;
            --light-bg: #f8f9fa;
            --dark-bg: #343a40;
            --card-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }
        
        body {
            background-color: #f5f7fb;
            color: #495057;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
        }
        
        .page-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #6c757d 150%);
            color: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
        }
        
        .memo-card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            overflow: hidden;
        }
        
        .memo-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }
        
        .card-header {
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
            border-bottom: 1px solid rgba(0,0,0,0.08);
            padding: 1.2rem 1.5rem;
            font-weight: 600;
        }
        
        .letter-head {
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .letter-head img {
            max-height: 150px;
            width: auto;
        }
        
        .memo-content {
            background-color: var(--light-bg);
            border-left: 4px solid var(--primary-color);
            padding: 1.5rem;
            border-radius: 0 8px 8px 0;
            font-size: 1.02rem;
        }
        
        .signature-section {
            border-top: 1px dashed #dee2e6;
            padding-top: 1.5rem;
            margin-top: 1.5rem;
        }
        
        .signature-pad-container {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background-color: white;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
        }
        
        .signature-pad {
            width: 50%;
            height: 180px;
            cursor: crosshair;
            border-radius: 4px;
        }
        
        .status-badge {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 500;
        }
        
        .action-buttons .btn {
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: var(--transition);
        }
        
        .btn-success {
            background: linear-gradient(to right, var(--success-color), #17a673);
            border: none;
        }
        
        .btn-info {
            background: linear-gradient(to right, var(--info-color), #3b9dbd);
            border: none;
        }
        
        .btn-danger {
            background: linear-gradient(to right, var(--danger-color), #e93c4b);
            border: none;
        }
        
        .btn-secondary {
            background: linear-gradient(to right, var(--secondary-color), #5a6268);
            border: none;
        }
        
        .modal-content {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        }
        
        .modal-header {
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
            border-bottom: 1px solid rgba(0,0,0,0.08);
            border-radius: 12px 12px 0 0;
            padding: 1.2rem 1.5rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(59, 125, 221, 0.25);
        }
        
        .minutes-section {
            background-color: #f8fafc;
            border-radius: 8px;
            padding: 1.5rem;
            border-left: 4px solid var(--info-color);
        }
        
        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
            }
            
            .action-buttons .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }
            
            .signature-pad-container {
                width: 50% !important;
            }
        }
        
        /* Animation classes */
        .animate-fade-in {
            animation: fadeIn 0.6s ease forwards;
        }
        
        .animate-slide-up {
            animation: slideUp 0.5s ease forwards;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideUp {
            from { 
                opacity: 0;
                transform: translateY(20px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container py-4 animate-fade-in">
        <!-- Header Section -->
        <div class="page-header animate-slide-up">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h2 class="mb-1"><i class="fas fa-file-alt me-2"></i>Review Memo</h2>
                    <p class="mb-0 opacity-75">Review and take action on the memorandum</p>
                </div>
                <span class="status-badge bg-{{ $memo->status === 'draft' ? 'secondary' : ($memo->status === 'validated' ? 'info' : ($memo->status === 'approved' ? 'success' : 'danger')) }}">
                    <i class="fas fa-circle me-1 small"></i>Status: {{ ucfirst($memo->status) }}
                </span>
            </div>
        </div>

        <!-- Memo Card -->
        <div class="card memo-card mb-4 animate-slide-up" style="animation-delay: 0.1s">
            <div class="card-body p-4">
                <!-- Letter Head -->
                <div class="text-center letter-head">
                    <img src="{{ asset('img/LETTER HEAD.jpeg') }}" alt="Company Letter Head" class="img-fluid" style="max-height: 100px;">
                </div>

                <!-- Memo Details -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-light rounded-circle p-3 me-3">
                                <i class="fas fa-user text-info"></i>
                            </div>
                            <div>
                                <p class="mb-0"><strong>To:</strong> {{ $memo->to }}</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-light rounded-circle p-3 me-3">
                                <i class="fas fa-user-circle text-info"></i>
                            </div>
                            <div>
                                <p class="mb-0"><strong>From:</strong> {{ $memo->from }}</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded-circle p-3 me-3">
                                <i class="fas fa-calendar text-info"></i>
                            </div>
                            <div>
                                <p class="mb-0"><strong>Date:</strong> {{ \Carbon\Carbon::parse($memo->date)->format('d M, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <!-- Subject and Body -->
                <div class="mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-light rounded-circle p-3 me-3">
                            <i class="fas fa-tag text-info"></i>
                        </div>
                        <div>
                            <p class="mb-0"><strong>Subject:</strong> <u>{{ $memo->subject }}</u></p>
                        </div>
                    </div>
                    
                    <div class="memo-content">
                        {!! nl2br(e($memo->body)) !!}
                    </div>
                </div>
                
                <!-- Signature Section -->
                <div class="signature-section">
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-md-5">
                            <h5 class="mb-3"><i class="fas fa-signature text-info me-2"></i>Sender Signature</h5>
                            @if($memo->signature)
                            <div class="border rounded p-3 text-center bg-white">
                                <img src="{{ asset('storage/' . $memo->signature) }}" alt="Signature" class="img-fluid" style="max-height: 100px;">
                                <p class="mb-0 mt-2 fw-bold">{{ $memo->name_of_employee }}</p>
                                <p class="mb-0 text-muted">{{ $memo->from }}</p>
                            </div>
                            @else
                            <div class="text-center py-4 bg-light rounded">
                                <i class="fas fa-signature display-4 text-muted mb-3"></i>
                                <p class="text-muted">No signature available</p>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Minutes Section -->
                        <div class="col-md-6">
                            @if($memo->minutes && $memo->status != 'draft')
                            <!-- <h5 class="mb-3"><i class="fas fa-comments text-info me-2"></i>Minutes & Comments</h5> -->
                            <div class="minutes-section">
                                <div class="mb-3">
                                    <!-- <p class="fw-bold mb-1">Minutes To:</p> -->
                                    <p class="mb-0">{!! nl2br(e($memo->minute_to)) !!}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <!-- <p class="fw-bold mb-1">Comments:</p> -->
                                    <p class="fst-italic mb-0">{!! nl2br(e($memo->minutes)) !!}</p>
                                </div>
                                
                                @if($memo->minute_signature)
                                <div class="mb-2">
                                    <!-- <p class="fw-bold mb-1">Approver Signature:</p> -->
                                    <div class="border rounded p-2 bg-white text-center">
                                        <img src="{{ asset('storage/' . $memo->minute_signature) }}" alt="Minute Signature" style="max-width:200px;" >
                                    </div>
                                </div>
                                @endif
                                
                                <div class="mb-0">
                                    <!-- <p class="fw-bold mb-1">Date:</p> -->
                                    <p class="text-muted mb-0">{!! nl2br(e($memo->minute_date)) !!}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
            @if($memo->status != 'approved' && $memo->status != 'rejected' && $memo->status != 'credited')
                <div class="mt-4 d-flex action-buttons flex-wrap animate-slide-up" style="animation-delay: 0.2s">
                    @if($memo->status == 'validated')
                        <button type="button" class="btn btn-info me-2 mb-2" data-bs-toggle="modal" data-bs-target="#minutesModal">
                            <i class="fas fa-comment me-2"></i> Add Minutes
                        </button>
                    @endif

                    @if($memo->status != 'draft')
                        <button type="button" class="btn btn-danger me-2 mb-2" data-bs-toggle="modal" data-bs-target="#rejectModal">
                            <i class="fas fa-times-circle me-2"></i> Reject
                        </button>
                    @endif

                    <form method="POST" action="{{ route('approvals.next-stage', $memo->id) }}" id="nextStageForm" class="d-inline mb-2">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check-circle me-2"></i> 
                            {{ $memo->status == 'draft' ? 'Submit Memo' : 'Approve Memo' }}
                        </button>
                    </form>
                </div>
            @endif
    </div>

    <!-- Minutes Modal -->
    @if($memo->status == 'validated')
    <div class="modal fade" id="minutesModal" tabindex="-1" aria-labelledby="minutesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-comments me-2"></i>Add Minutes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="minutesForm" method="POST" action="{{ route('memos.addMinutes', $memo->id) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="minute_to" class="form-label fw-semibold">Minutes To:</label>
                            <input type="text" class="form-control" id="minute_to" name="minute_to" 
                                value="{{ old('minute_to', $memo->minute_to ?? '') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="minutes" class="form-label fw-semibold">Minutes/Comment:</label>
                            <textarea class="form-control" id="minutes" name="minutes" rows="5" required>{{ old('minutes', $memo->minutes ?? '') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Signature:</label>
                            <div class="signature-pad-container mx-auto" style="width: 100%;">
                                <canvas id="signature-pad" class="signature-pad"></canvas>
                            </div>
                            <input type="hidden" id="signature" name="minute_signature">
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <small class="text-muted">Draw your signature above</small>
                                <button type="button" id="clearSignature" class="btn btn-sm btn-warning">
                                    <i class="fas fa-eraser me-1"></i> Clear
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="minute_date" class="form-label fw-semibold">Date:</label>
                            <input type="date" class="form-control @error('minute_date') is-invalid @enderror" 
                                id="minute_date" name="minute_date" required value="{{ old('minute_date', now()->format('Y-m-d')) }}">
                            @error('minute_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-save me-1"></i> Save Minutes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-times-circle me-2"></i>Reject Memo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('approvals.previous-stage', $memo->id) }}" id="rejectForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="reject_reason" class="form-label fw-semibold">Reason for rejection:</label>
                            <textarea class="form-control" id="reject_reason" name="minutes" rows="4" placeholder="Please provide the reason for rejecting this memo..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Confirm Rejection</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.5/dist/signature_pad.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let signaturePad = null;
            
            // Initialize signature pad
            function initSignaturePad() {
                const canvas = document.getElementById('signature-pad');
                if (!canvas) return;
                
                // Clear existing signature pad if any
                if (signaturePad) {
                    signaturePad.off();
                    signaturePad = null;
                }
                
                // Set up canvas
                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.getContext("2d").scale(ratio, ratio);
                
                // Initialize signature pad
                signaturePad = new SignaturePad(canvas, {
                    minWidth: 1,
                    maxWidth: 3,
                    penColor: "rgb(0, 0, 0)",
                    backgroundColor: "rgb(255, 255, 255)",
                    throttle: 16,
                });
                
                // Make responsive
                function resizeCanvas() {
                    const ratio = Math.max(window.devicePixelRatio || 1, 1);
                    canvas.width = canvas.offsetWidth * ratio;
                    canvas.height = canvas.offsetHeight * ratio;
                    canvas.getContext("2d").scale(ratio, ratio);
                    
                    if (signaturePad) {
                        const data = signaturePad.toData();
                        signaturePad.clear();
                        if (data) {
                            signaturePad.fromData(data);
                        }
                    }
                }
                
                window.addEventListener('resize', resizeCanvas);
            }
            
            // Initialize when minutes modal is shown
            const minutesModal = document.getElementById('minutesModal');
            if (minutesModal) {
                minutesModal.addEventListener('shown.bs.modal', initSignaturePad);
            }
            
            // Clear signature functionality
            const clearButton = document.getElementById('clearSignature');
            if (clearButton) {
                clearButton.addEventListener('click', function() {
                    if (signaturePad) {
                        signaturePad.clear();
                    }
                });
            }
            
            // Handle minutes form submission
            const minutesForm = document.getElementById('minutesForm');
            if (minutesForm) {
                minutesForm.addEventListener('submit', function(e) {
                    if (!signaturePad || signaturePad.isEmpty()) {
                        e.preventDefault();
                        alert('Please provide your signature before saving.');
                        return;
                    }
                    
                    // Save signature image to hidden field
                    const signatureData = signaturePad.toDataURL('image/png');
                    document.getElementById('signature').value = signatureData;
                });
            }
            
            // Set today's date as default for minute_date field
            const minuteDateField = document.getElementById('minute_date');
            if (minuteDateField && !minuteDateField.value) {
                const today = new Date();
                minuteDateField.value = today.toISOString().substr(0, 10);
            }
            
            // Add animation to elements when scrolling
            const animatedElements = document.querySelectorAll('.animate-slide-up');
            
            function checkScroll() {
                animatedElements.forEach(element => {
                    const elementPosition = element.getBoundingClientRect().top;
                    const screenPosition = window.innerHeight / 1.3;
                    
                    if (elementPosition < screenPosition) {
                        element.style.opacity = 1;
                        element.style.transform = 'translateY(0)';
                    }
                });
            }
            
            // Initial check
            checkScroll();
            
            // Check on scroll
            window.addEventListener('scroll', checkScroll);
        });
    </script>
</body>
</html>
@endsection