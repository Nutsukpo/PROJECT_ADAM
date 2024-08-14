@extends('layout.master')

@section('title','Add payment')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <form class="payments" action="{{route('payments.create')}}" method="POST">
            @csrf
            <div>
                <h5 class="text-dark">Adding Employee Payment </h5>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Voucher Id</label>
                    <input type="text" class="form-control  @error('voucher_id') is-invalid @enderror" 
                    placeholder="Enter voucher id" name="voucher_id" required 
                    value="{{old('voucher_id')}}">
                    @error('voucher_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label>Payment Date</label>
                    <input type="Date" class="form-control  @error('payment_date') is-invalid @enderror"
                    placeholder="Enter Last Name" name="payment_date" required 
                    value="{{old('payment_date')}}">
                    @error('payment_date')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Name Of Employee</label>  
                    <select type="text" class="form-control  @error('name_of_employee') is-invalid @enderror" 
                    placeholder="Enter name of employee" name="name_of_employee"  id="employee_id" required >
                        <option value="">select employee</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->firstname }} {{ $employee->lastname }}">{{ $employee->firstname }} {{ $employee->lastname }}</option>
                        @endforeach
                    </select>
                    @error('employee_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Month Of Payment</label>
                    <input type="month" class="form-control  @error('month_of_payment') is-invalid @enderror" 
                    placeholder="Enter month of payment" name="month_of_payment" required 
                    value="{{old('month_of_payment')}}">
                    @error('month_of_payment')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Payment Amount</label>
                    <input type="text" class="form-control  @error('payment_amount') is-invalid @enderror" 
                    placeholder="Enter payment_amount" name="payment_amount" required 
                    value="{{old('payment_amount')}}">
                    @error('payment_amount')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Payment Description</label>
                    <input type="text" class="form-control  @error('purpose_of_payment') is-invalid @enderror" 
                    placeholder="Enter purpose of payment" name="purpose_of_payment" required 
                    value="{{old('purpose_of_payment')}}">
                    @error('purpose_of_payment')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn text-light btn-user btn-block" style="background-color:cadetblue">
                Save
            </button>
            <hr>
        </form>
    </div>
</div>  
@endsection



