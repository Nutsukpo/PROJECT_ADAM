@extends('layout.master')

@section('title','Add Memo')

@section('head')
    
@endsection

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Memo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.5/dist/signature_pad.umd.min.js"></script>
    <style>
        :root {
            --primary-color: #5F9EA0;
            --secondary-color: #1E3233;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
            --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        body {
            background-color: var(--light-bg);
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .header-container {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-radius: 0 0 6px 7px;
        }
        
        .memo-card {
            background: white;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .form-control, .form-select {
            border: 2px solid #e1e5eb;
            border-radius: 6px;
            padding: 0.75rem;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        
        .btn-primary {
            background-color: var(--secondary-color);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }
        
        .btn-outline-secondary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s;
        }
        
        .btn-outline-secondary:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn-warning {
            background-color: #f39c12;
            border: none;
            font-weight: 600;
        }
        
        #signature-pad {
            border: 2px dashed #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
            cursor: crosshair;
            margin-bottom: 1rem;
        }
        
        .signature-container {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }
        
        .section-title {
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
            font-weight: 700;
        }
        
        .alert-danger {
            background-color: #ffeaea;
            color: #e74c3c;
            border: none;
            border-left: 4px solid #e74c3c;
            border-radius: 4px;
        }
        
        .required-field::after {
            content: "*";
            color: var(--accent-color);
            margin-left: 4px;
        }
        
        @media (max-width: 768px) {
            .memo-card {
                padding: 1.5rem;
            }
            
            .header-container h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="header-container">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2><i class="fas fa-file-alt me-2"></i>Create New Memo</h2>
                <a href="{{ route('memos.index') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left me-1"></i> Back to Memos
                </a>
            </div>
        </div>
    </div>

    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <strong><i class="fas fa-exclamation-circle me-2"></i>There were some problems with your input:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('memos.store') }}" method="POST" id="memoForm">
            @csrf
            
            <div class="memo-card">
                <h4 class="section-title"><i class="fas fa-info-circle me-2"></i>Memo Details</h4>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="to" class="form-label required-field">To</label>
                        <input type="text" name="to" class="form-control" value="{{ old('to') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="from" class="form-label required-field">From</label>
                        <input type="text" name="from" class="form-control" value="{{ old('from') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="date" class="form-label required-field">Date</label>
                        <input type="date" name="date" class="form-control" value="{{ old('date') ?? date('Y-m-d') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="name_of_employee" class="form-label required-field">Name of Staff</label>
                        <input type="text" name="name_of_employee" class="form-control" value="{{ old('name_of_employee') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="subject" class="form-label required-field">Subject</label>
                    <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" required>
                </div>

                <div class="mb-4">
                    <label for="body" class="form-label">Body</label>
                    <textarea name="body" class="form-control" rows="4">{{ old('body') }}</textarea>
                </div>
            </div>

            <div class="memo-card">
                <h4 class="section-title"><i class="fas fa-money-bill-wave me-2"></i>Financial Details</h4>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <div class="input-group">
                            <span class="input-group-text">GHS</span>
                            <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount') }}">
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="currency" class="form-label">Currency</label>
                        <select name="currency" class="form-select">
                            <option value="GHS" selected>Ghana Cedi (GHS)</option>
                            <option value="USD">US Dollar (USD)</option>
                            <option value="EUR">Euro (EUR)</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="memo-card">
                <h4 class="section-title"><i class="fas fa-pen me-1"></i>Signature</h4>
                <div class="signature-container">
                    <p class="text-muted mb-2">Please provide your signature in the box below:</p>
                    <canvas id="signature-pad" width="350" height="200"></canvas>
                    <div class="d-flex justify-content-between align-items-center mt-1">
                        <button type="button" id="clear" class="btn btn-danger">
                            <i class="fas fa-eraser me-1"></i> Clear Signature
                        </button>
                        <small class="text-muted">Sign above using mouse or touch</small>
                    </div>
                </div>
                <!-- Hidden input to store signature data -->
                <input type="hidden" name="signature" id="signature">
            </div>


            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-5">
                <button type="reset" class="btn btn-outline-secondary me-md-2">
                    <i class="fas fa-redo me-1"></i> Reset Form
                </button>
                <button type="submit" class="text-light " style="background-color: cadetblue;">
                    <i class="fas fa-plus-circle me-1"></i> Create Memo
                </button>
            </div>
        </form>
    </div>

     <!-- Signature Pad Library -->
     <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.5/dist/signature_pad.umd.min.js"></script>
    <script>
        const canvas = document.getElementById('signature-pad');
        const signaturePad = new SignaturePad(canvas);

        document.querySelector('form').addEventListener('submit', function (e) {
            if (!signaturePad.isEmpty()) {
                document.getElementById('signature').value = signaturePad.toDataURL();
            } else {
                alert("Please provide a signature.");
                e.preventDefault();
            }
        });

        document.getElementById('clear').addEventListener('click', function () {
            signaturePad.clear();
        });
    </script>
</body>
</html>
@endsection





