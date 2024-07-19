@extends('layout.master')

@section('title','watch Employee')

@section('content')
<div>
    <h2 class="bg info">Details of Employee </h2>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form class="employee" action="/employees/{{$employee->id}}/update" method="POST">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>FIRST NAME: </label>
                    <h6>{{$employee->firstname}}</h6>
                </div>
                <div class="col-sm-6">
                    <label>LAST NAME:  </label>
                    <h6>{{$employee->lastname}}</h6>
                </div>
                </div>
                <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>EMPLOYEE ID: </label>
                    <h6>{{$employee->employee_id}}</h6>
                </div>
                <div class="col-sm-6">
                    <label>DEPARTMENT: </label>
                    <h6>{{$employee->department}}</h6>
                </div>
                </div>
                <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>EMAIL: </label>
                    <h6>{{$employee->email}}</h6>
                </div>
                <div class="col-sm-6">
                    <label>CONTACT: </label>
                    <h6>{{$employee->contact}}</h6>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                <label>ADDRESS: </label>
                <h6>{{$employee->address}}</h6>
            </div>
            <div class="col-sm-6">
                <label>POSITION: </label>
                <h6>{{$employee->position}}</h6>
                </div>
            </div>
        </form>
    </div>
        <div class="col-lg-6 d-none d-lg-block bg-login-image img-fluid float-end">
            <img class="img-profile-small pt-5"style="size: 20px; width:100%" src="{{asset('img/officeassistant.png')}}">
        </div>
</div>
@endsection