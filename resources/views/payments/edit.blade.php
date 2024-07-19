@extends('layout.master')

@section('title','Edit Payment')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <form class="payments" action="/payments/{{$payment->id}}/update" method="POST">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Voucher Id</label>
                    <input type="text" class="form-control  @error('voucher_id') is-invalid @enderror" 
                    placeholder="Enter voucher id" name="voucher_id" required 
                    value="{{$payment->voucher_id}}">
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
                    value="{{$payment->payment_date}}">
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
                    <input type="text" class="form-control  @error('name_of_employee') is-invalid @enderror" 
                    placeholder="Enter name of employee" name="name_of_employee" required 
                    value="{{$payment->name_of_employee}}">
                    @error('name_of_employee')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Month Of Payment</label>
                    <input type="text" class="form-control  @error('month_of_payment') is-invalid @enderror" 
                    placeholder="Enter month of payment" name="month_of_payment" required 
                    value="{{$payment->month_of_payment}}">
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
                    value="{{$payment->payment_amount}}">
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
                    value="{{$payment->purpose_of_payment}}">
                    @error('purpose_of_payment')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
                <button type="submit" class="btn text-light btn-user btn-block" style="background-color: cadetblue;">
                Update
                </button>
            
        </form>
    </div>
</div>
@endsection