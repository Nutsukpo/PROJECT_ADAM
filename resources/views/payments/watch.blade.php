@extends('layout.master')

@section('title','Watch Payment')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between">
    <h5 class="bg info">Details of Employee Payment </h5>
    <a href="#" class="d-none d-sm-inline-block text-light btn btn-sm shadow-sm" style="background-color:cadetblue"><i class="fas fa-download fa-sm text-light"></i> Generate P.Voucher</a>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form class="payments" action="/payments/{{$payment->id}}/update" method="POST">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Voucher Id</label>
                    <h5>{{$payment->voucher_id}}</h5>
                </div>
                <div class="col-sm-6">
                    <label>Payment Date</label>
                    <h5>{{$payment->payment_date}}</h5>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Name Of Employee</label>
                    <h5>{{$payment->name_of_employee}}</h5>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Month Of Payment</label>
                    <h5>{{$payment->month_of_payment}}</h5>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Payment Amount</label>
                    <h5>{{$payment->payment_amount}}</h5>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Payment Description</label>
                    <h5>{{$payment->purpose_of_payment}}</h5>
                </div>
            </div>   
        </form>
    </div>
        <div class="col-lg-6 d-none d-lg-block bg-login-image d-sm-flex align-items-center justify-content-between">
            <img class="img-profile-small pt-5"style="size: 20px; width:100%" src="{{asset('img/officeassistant.png')}}">
        </div>
</div>
@endsection