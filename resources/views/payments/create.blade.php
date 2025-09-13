@extends('layout.master')

@section('title', 'Add Payment')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header text-white" style="background-color: cadetblue;">
                    <h3 class="text-center font-weight-light my-4">New Payment Voucher</h3>
                </div>
                <div class="card-body">
                    <form class="payments" action="{{ route('payments.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <label for="voucher_id">P-V ID</label>
                                    <input type="text" class="form-control @error('voucher_id') is-invalid @enderror" 
                                           id="voucher_id" placeholder="Voucher ID" name="voucher_id" readonly
                                           value="{{ old('voucher_id') }}">
                                    @error('voucher_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <label for="payment_date">Payment Date</label>
                                    <input type="date" class="form-control @error('payment_date') is-invalid @enderror"
                                           id="payment_date" placeholder="Payment Date" name="payment_date" required 
                                           value="{{ old('payment_date') }}">
                                    @error('payment_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Employee and Month of Payment -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <label for="employee_id">Name of Employee</label>
                                    <select class="form-control @error('name_of_employee') is-invalid @enderror" 
                                            id="employee_id" name="name_of_employee" required>
                                        <option value="">Select employee</option>
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->firstname }} {{ $employee->lastname }}"
                                                {{ old('name_of_employee') == "$employee->firstname $employee->lastname" ? 'selected' : '' }}>
                                                {{ $employee->firstname }} {{ $employee->lastname }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('name_of_employee')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <label for="month_of_payment">Month of Payment</label>
                                    <input type="month" class="form-control @error('month_of_payment') is-invalid @enderror" 
                                           id="month_of_payment" placeholder="Month of Payment" name="month_of_payment" required 
                                           value="{{ old('month_of_payment') }}">
                                    @error('month_of_payment')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Payment Amount and Description -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <label for="payment_amount">Payment Amount</label>
                                    <input type="text" class="form-control @error('payment_amount') is-invalid @enderror" 
                                           id="payment_amount" placeholder="Payment Amount" name="payment_amount" required 
                                           value="{{ old('payment_amount') }}">
                                    @error('payment_amount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <label for="purpose_of_payment">Payment Description</label>
                                    <input type="text" class="form-control @error('purpose_of_payment') is-invalid @enderror" 
                                           id="purpose_of_payment" placeholder="Purpose of Payment" name="purpose_of_payment" required 
                                           value="{{ old('purpose_of_payment') }}">
                                    @error('purpose_of_payment')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-info btn-lg bg-info">
                                <i class="fas fa-save me-2"></i> Save P-V
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <small class="text-muted">All fields are required</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
        border-radius: 15px 15px 0 0 !important;
        padding: 1.5rem;
    }
    
    .form-floating {
        position: relative;
        margin-bottom: 1rem;
    }
    
    .form-control {
        height: calc(3.5rem + 2px);
        padding: 1rem 0.75rem;
        border-radius: 10px;
        border: 1px solid #ced4da;
    }
    
    .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    
    .btn-info {
        background-color: #0d6efd;
        border-color: #0d6efd;
        padding: 0.75rem;
        font-weight: 500;
        border-radius: 10px;
    }
    
    .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }
    
    .invalid-feedback {
        display: block;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #dc3545;
    }
</style>
@endsection