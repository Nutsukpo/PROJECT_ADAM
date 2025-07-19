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
        
                <div class="container">
                    <div class="row">
                        <!-- Column 1 -->
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label>FIRST NAME: </label>
                                        <h6>{{$employee->firstname}}</h6>
                                    </div><br/>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label>LAST NAME: </label>
                                        <h6>{{$employee->lastname}}</h6>
                                    </div><br/>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label>STAFF ID: </label>
                                        <h6>{{$employee->employee_id}}</h6>
                                    </div><br>
                                    <div class="col-sm-6 ">
                                        <label>POSITION: </label>
                                        <h6>{{$employee->position}}</h6>
                                    </div><br/><br/>
                                </div>
                            </div>
                        </div>

                        <!-- Column 2 -->
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="col-sm-6">
                                        <label>CONTACT: </label>
                                        <h6>{{$employee->contact}}</h6>
                                    </div><br/>
                                    <div class="col-sm-6">
                                        <label>DEPARTMENT: </label>
                                        <h6>{{$employee->department}}</h6>
                                    </div><br>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label>EMAIL: </label>
                                        <h6>{{$employee->email}}</h6>
                                    </div>
                                    <br>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label>ADDRESS: </label>
                                        <h6>{{$employee->address}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Column 3 -->
                        <div class="col-md-4">
                            <div class="card mb-5">
                                
                                <div class="card-body">
                                    <label >STAFF IMAGE : </label><br>
                                        <div class="">
                                        <img title="{{$employee->firstname}} {{$employee->lastname}} {{$employee->contact}}"class="img-profile-small pt-1" style="size: 20px; width:100%; height:100%;" 
                                            src="{{ asset(path: 'storage/'. $employee->picture)}}" 
                                            alt="Employee Picture" width="100" height="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
    <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image d-sm-flex align-items-center justify-content-between">
            <img class="img-profile-small pt-5"style="size: 20px; width:100%" src="{{asset('img/officeassistant.png')}}">
        </div> -->
</div>
@endsection


                    