@extends('layout.master')

@section('title','Edit Employee')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <form class="employee" action="/employees/{{$employee->id}}/update" method="POST">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>First Name</label>
                    <input type="text" class="form-control form-control-user @error('firstname') is-invalid @enderror" 
                    placeholder="Enter First Name.." name="firstname" required 
                    value="{{$employee->firstname}}">
                    @error('firstname')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label>Last Name</label>
                    <input type="text" class="form-control form-control-user @error('lastname') is-invalid @enderror"
                    placeholder="Enter Last Name" name="lastname" required 
                    value="{{$employee->lastname}}">
                    @error('lastname')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Employee ID</label>
                    <input type="text" class="form-control form-control-user @error('student_id') is-invalid @enderror" 
                    placeholder="Enter Employee ID" name="employee_id" readonly 
                    value="{{$employee->employee_id}}">
                    @error('employee_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label>Department</label>
                    <input type="text" class="form-control  @error('gender') is-invalid @enderror" 
                    placeholder="Enter department" name="department" 
                    value="{{$employee->department}}">
                    @error('department')
                    <div class="invalid-feedback">
                    {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Email</label>
                    <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" 
                    placeholder="Enter Student's Email" name="email" required 
                    value="{{$employee->email}}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label>Contact</label>
                    <input type="text" class="form-control form-control-user @error('contact') is-invalid @enderror" 
                    placeholder="Enter Employee's Contact" name="contact" required 
                    value="{{$employee->contact}}">
                    @error('contact')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Address</label>
                    <input type="text" class="form-control form-control-user @error('address') is-invalid @enderror" 
                    id="exampleInputEmail" aria-describedby="emailHelp" 
                    placeholder="Enter Employee's Address" name="address" required 
                    value="{{$employee->address}}">
                    @error('address')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Position</label>
                    <input type="text" class="form-control form-control-user @error('position') is-invalid @enderror" 
                    placeholder="Enter Employee's Position" name="position" required 
                    value="{{$employee->position}}">
                    @error('position')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-user text-light btn-block" style="background-color: cadetblue;">
                Update
            </button>
            <hr>
        </form>
    </div>
</div>
@endsection