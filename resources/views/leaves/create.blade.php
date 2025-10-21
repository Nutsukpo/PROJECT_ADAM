@extends('layout.master')

@section('title','Applying Leave')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply Leave</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #5F9EA0;
            --primary-light: #e8f0fe;
            --secondary-color: #5F9EA0;
            --accent-color: #34a853;
            --border-color: #dadce0;
            --text-primary: #202124;
            --text-secondary: #5f6368;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', 'Roboto', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-primary);
            line-height: 1.6;
        }
        
        .application-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        
        .card-header {
            background: linear-gradient(120deg, #5F9EA0, #7da5a4);
            color: white;
            border-bottom: none;
            padding: 1.5rem 2rem;
        }
        
        .card-body {
            padding: 2rem;
        }
        
        .section-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--primary-light);
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 60px;
            height: 2px;
            background-color: var(--primary-color);
        }
        
        .section-guide {
            color: var(--text-secondary);
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            padding: 0.75rem 1rem;
            background-color: var(--primary-light);
            border-radius: 8px;
            border-left: 4px solid var(--primary-color);
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }
        
        .form-label.required::after {
            content: " *";
            color: #dc3545;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            transition: all 0.2s ease;
        }
        
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.2);
            border-color: var(--primary-color);
        }
        
        .form-control-lg {
            padding: 1rem 1.25rem;
            font-size: 1.05rem;
        }
        
        .input-group-text {
            background-color: #f1f3f4;
            border: 1px solid var(--border-color);
        }
        
        #signature-pad {
            border: 1px dashed #ccc;
            border-radius: 8px;
            background-color: white;
            cursor: crosshair;
            width: 50%;
            height: 100%;
            touch-action: none;
        }
        
        .signature-container {
            position: relative;
            margin-bottom: 1rem;
        }
        
        .signature-clear {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
        }
        
        .official-section {
            background: linear-gradient(to bottom, #f8f9fa, #fff);
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 1.5rem;
        }
        
        .official-title {
            color: #5f6368;
            font-weight: 600;
            border-bottom: 1px dashed #dadce0;
            padding-bottom: 0.75rem;
            margin-bottom: 1.5rem;
        }
        
        .btn-primary {
            background: linear-gradient(120deg, #1a73e8, #1e88e5);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(120deg, #1967d2, #1a73e8);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(26, 115, 232, 0.3);
        }
        
        .btn-outline-secondary {
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
        }
        
        .info-badge {
            display: inline-flex;
            align-items: center;
            background-color: var(--primary-light);
            color: var(--primary-color);
            padding: 0.35rem 0.75rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        .info-badge i {
            margin-right: 0.4rem;
        }
        
        .calculation-hint {
            font-size: 0.85rem;
            color: var(--text-secondary);
            margin-top: 0.4rem;
        }
        
        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem;
            }
            
            .card-header {
                padding: 1.25rem;
            }
            
            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }
            
            .d-flex.gap-3 {
                flex-direction: column;
            }
        }
        
        .step-progress {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            position: relative;
        }
        
        .step-progress::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #e9ecef;
            z-index: 1;
        }
        
        .step {
            position: relative;
            z-index: 2;
            text-align: center;
            width: 100%;
        }
        
        .step-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
            font-size: 14px;
            color: #6c757d;
        }
        
        .step.active .step-icon {
            background-color: var(--primary-color);
            color: white;
        }
        
        .step.completed .step-icon {
            background-color: var(--accent-color);
            color: white;
        }
        
        .step-text {
            font-size: 0.8rem;
            color: #6c757d;
        }
        
        .step.active .step-text {
            color: var(--primary-color);
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container py-4 application-container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0 fw-bold"><i class="fas fa-file-alt me-2"></i>Apply for Leave</h4>
                    <p class="mb-0 mt-1 opacity-75">Complete the form below to submit your leave request</p>
                </div>
                <a href="{{ route('leaves.index') }}" class="btn btn-sm btn-outline-light rounded-pill">
                    <i class="fas fa-arrow-left me-1"></i> Back to Leaves
                </a>
            </div>

            <div class="card-body">
                <!-- Progress Steps -->
                <div class="step-progress mb-4">
                    <div class="step active">
                        <div class="step-icon">1</div>
                        <div class="step-text">Applicant Info</div>
                    </div>
                    <div class="step">
                        <div class="step-icon">2</div>
                        <div class="step-text">Leave Details</div>
                    </div>
                    <div class="step">
                        <div class="step-icon">3</div>
                        <div class="step-text">Signature</div>
                    </div>
                    <div class="step">
                        <div class="step-icon">4</div>
                        <div class="step-text">Review</div>
                    </div>
                </div>

                <form action="{{ route('leaves.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf

                    <!-- Applicant Details -->
                    <div class="mb-5">
                        <h5 class="section-title">Your Details</h5>
                        <div class="section-guide">
                            <i class="fas fa-info-circle me-2"></i>Please provide your personal information and select the type of leave you're applying for.
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="fullName" class="form-label required">Full Name</label>
                                <input type="text" id="fullName" name="full_name" class="form-control form-control-lg" placeholder="" required>
                            </div>
                            <div class="col-md-6">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" id="designation" name="designation" class="form-control form-control-lg" placeholder="">
                            </div>
                            <div class="col-md-6">
                                <label for="contactNumber" class="form-label">Contact Number</label>
                                <div class="input-group">
                                    <span class="input-group-text">+233</span>
                                    <input type="tel" id="contactNumber" name="contact_number" class="form-control form-control-lg" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="leaveType" class="form-label required">Leave Type</label>
                                <select id="leaveType" name="leave_type" class="form-select form-select-lg" required>
                                    <option value="" disabled selected>— Select leave type —</option>
                                    <option>Annual leave</option>
                                    <option>Part leave</option>
                                    <option>Maternity leave</option>
                                    <option>Sick leave</option>
                                    <option>Unpaid leave</option>
                                    <option>Leave of Absence</option>
                                    <option>Funeral-Relationship</option>
                                    <option>Vacation leave</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="reason" class="form-label">Reason for Leave</label>
                                <textarea id="reason" name="reason" class="form-control" rows="3" placeholder="Briefly explain the reason for your leave..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Leave Details -->
                    <div class="mb-5">
                        <h5 class="section-title">Leave Period</h5>
                        <div class="section-guide">
                            <i class="fas fa-info-circle me-2"></i>Provide the dates for your leave. The number of days will be calculated automatically.
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="dateCommencement" class="form-label required">Date of Commencement</label>
                                <input type="date" id="dateCommencement" name="date_commencement" class="form-control form-control-lg" required>
                            </div>
                            <div class="col-md-6">
                                <label for="dateResumption" class="form-label required">Date of Resumption</label>
                                <input type="date" id="dateResumption" name="date_resumption" class="form-control form-control-lg" required>
                            </div>
                            <div class="col-md-6">
                                <label for="daysApplied" class="form-label">Days Applied For</label>
                                <input type="number" id="daysApplied" name="days_applied_for" class="form-control form-control-lg bg-light" min="0" readonly>
                                <div class="calculation-hint">This field is automatically calculated based on your selected dates</div>
                            </div>
                            <div class="col-md-6">
                                <label for="date_of_application" class="form-label required">Date of Application</label>
                                <input type="date" id="date_of_application" name="date_of_application" class="form-control form-control-lg" required>
                            </div>
                        </div>
                    </div>

                    <!-- Previous Leave Info -->
                    <div class="mb-5">
                        <h5 class="section-title">Previous Leave Information</h5>
                        <div class="section-guide">
                            <i class="fas fa-info-circle me-2"></i>Provide information about your previous leave (if applicable).
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="dateLastLeave" class="form-label">Date of Last Leave</label>
                                <input type="date" id="dateLastLeave" name="date_last_leave" class="form-control form-control-lg">
                            </div>
                            <div class="col-md-6">
                                <label for="daysEntitled" class="form-label">Days Entitled</label>
                                <input type="number" id="daysEntitled" name="days_entitled" class="form-control form-control-lg" min="0">
                            </div>
                            <div class="col-md-6">
                                <label for="daysUtilized" class="form-label">Days Already Utilized</label>
                                <input type="number" id="daysUtilized" name="days_already_utilized" class="form-control form-control-lg" min="0">
                            </div>
                        </div>
                    </div>

                    <!-- Signature & Submission -->
                    <div class="mb-5">
                        <h5 class="section-title">Signature</h5>
                        <div class="section-guide">
                            <i class="fas fa-info-circle me-2"></i>By signing, you confirm that the information provided is accurate and complete.
                        </div>
                        
                        <div class="signature-container">
                            <canvas id="signature-pad" width="250" height="150"></canvas>
                            <button type="button" id="clear" class="btn btn-sm btn-outline-danger signature-clear">
                                <i class="fas fa-eraser me-1"></i> Clear
                            </button>
                        </div>
                        <input type="hidden" name="signature" id="signature">
                        <div class="calculation-hint">Draw your signature in the box above</div>
                    </div>

                    <!-- Official Use Only -->
                    <div class="official-section mb-5">
                        <h5 class="official-title"><i class="fas fa-lock me-2"></i>For Official Use Only</h5>
                        <div class="section-guide">
                            <i class="fas fa-exclamation-circle me-2"></i>This section is for administrative purposes and should not be filled by the applicant.
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="respectOf" class="form-label">Application for Leave in Respect of</label>
                                <input type="text" id="respectOf" name="respect_of" class="form-control" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="recommendation" class="form-label">Recommendation</label>
                                <select id="recommendation" name="recommendation" class="form-select" disabled>
                                    <option value="" disabled selected>— Select —</option>
                                    <option value="recommended">Recommended</option>
                                    <option value="not_recommended">Not Recommended</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="daysApplied" class="form-label">Days Granted</label>
                                <input type="number" id="daysGranted" name="days_granted" class="form-control form-control-lg bg-light" min="0" >
                                <div class="calculation-hint">This field is based on the coordinators discretion</div>
                            </div>
                            <div class="col-md-6">
                                <label for="dateResumption" class="form-label required">Date of Resumption</label>
                                <input type="date" id="dateResumption" name="date_resumption" class="form-control form-control-lg" required disabled>
                            </div>
                        </div>
                        
                        
                        <div class="row g-4 mt-3">
                            <!-- Admin -->
                            <div class="col-md-6">
                                <div class="p-3 bg-white border rounded-3">
                                    <h6 class="text-info fw-bold mb-3"><i class="fas fa-user-shield me-2"></i>Administrator</h6>
                                    <div class="mb-3">
                                        <label for="adminName" class="form-label">Name</label>
                                        <input type="text" id="adminName" name="administrator_name" class="form-control"disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="adminSignature" class="form-label">Signature</label>
                                        <input type="text" id="adminSignature" name="administrator_signature" class="form-control" disabled>
                                    </div>
                                    <div>
                                        <label for="adminDate" class="form-label">Date</label>
                                        <input type="date" id="adminDate" name="administrator_date" class="form-control"disabled>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Zonal Coordinator -->
                            <div class="col-md-6">
                                <div class="p-3 bg-white border rounded-3">
                                    <h6 class="text-info fw-bold mb-3"><i class="fas fa-user-tie me-2"></i>Zonal Coordinator</h6>
                                    <div class="mb-3">
                                        <label for="zonalName" class="form-label">Name</label>
                                        <input type="text" id="zonalName" name="zonal_coordinator_name" class="form-control" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="zonalSignature" class="form-label">Signature</label>
                                        <input type="text" id="zonalSignature" name="zonal_coordinator_signature" class="form-control" disabled>
                                    </div>
                                    <div>
                                        <label for="zonalDate" class="form-label">Date</label>
                                        <input type="date" id="zonalDate" name="zonal_coordinator_date" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit and Cancel Buttons -->
                    <div class="d-flex justify-content-end gap-3 mt-5">
                        <a href="{{ route('leaves.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-info btn-lg px-4">
                            <i class="fas fa-paper-plane me-2"></i>Submit Application
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.5/dist/signature_pad.umd.min.js"></script>
    <script>
        // Initialize signature pad
        const canvas = document.getElementById('signature-pad');
        const signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgb(255, 255, 255)'
        });
        
        // Adjust canvas size for high DPI displays
        function resizeCanvas() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
            signaturePad.clear();
        }
        
        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();

        // Form submission handler
        document.querySelector('form').addEventListener('submit', function (e) {
            if (!signaturePad.isEmpty()) {
                document.getElementById('signature').value = signaturePad.toDataURL();
            } else {
                e.preventDefault();
                alert('Please provide your signature before submitting the form.');
            }
        });

        // Clear signature
        document.getElementById('clear').addEventListener('click', function () {
            signaturePad.clear();
        });

        // Auto-calculate days applied
        const commencementDate = document.getElementById('dateCommencement');
        const resumptionDate = document.getElementById('dateResumption');
        const daysApplied = document.getElementById('daysApplied');

        function calculateDays() {
            if (commencementDate.value && resumptionDate.value) {
                const start = new Date(commencementDate.value);
                const end = new Date(resumptionDate.value);
                
                // Validate that end date is after start date
                if (end <= start) {
                    alert('Resumption date must be after commencement date');
                    resumptionDate.value = '';
                    daysApplied.value = '';
                    return;
                }
                
                const diffTime = Math.abs(end - start);
                daysApplied.value = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            }
        }

        commencementDate.addEventListener('change', calculateDays);
        resumptionDate.addEventListener('change', calculateDays);
        
        // Add today's date to the application date field by default
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date();
            const yyyy = today.getFullYear();
            let mm = today.getMonth() + 1;
            let dd = today.getDate();
            
            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;
            
            const formattedToday = `${yyyy}-${mm}-${dd}`;
            document.getElementById('date_of_application').value = formattedToday;
        });
    </script>
</body>
</html>
@endsection