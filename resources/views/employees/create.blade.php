@extends('layout.master')

@section('title','Add Employee')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <form class="employee" action="{{route('employee.create')}}" method="POST">
            @csrf
            <div>
                <h5 class="text-dark">Adding Employee </h5>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>First Name</label>
                    <input type="text" class="form-control  @error('firstname') is-invalid @enderror" 
                    placeholder="Enter First Name.." name="firstname" required 
                    value="{{old('firstname')}}">
                    @error('firstname')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label>Last Name</label>
                    <input type="text" class="form-control  @error('lastname') is-invalid @enderror"
                    placeholder="Enter Last Name" name="lastname" required 
                    value="{{old('lastname')}}">
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
                    <input type="id" class="form-control  @error('student_id') is-invalid @enderror" 
                    placeholder="Enter Employee ID" name="employee_id" required 
                    value="{{old('employee_id')}}">
                    @error('employee_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label>Department</label>
                    <select class="form-control" name="department" >
                        <option value="coordinator" {{old('department')=='csd'?'selected':''}}>Coordinator</option>
                        <option value="engineering" {{old('department')=='csd'?'selected':''}}>Engineering</option>
                        <option value="administration" {{old('department')=='csd'?'selected':''}}>Administration</option>
                        <option value="accounting" {{old('department')=='csd'?'selected':''}}>Accounting</option>
                        <option value="info tech" {{old('department')=='csd'?'selected':''}}>Info Tech</option>
                        <option value="led" {{old('department')=='csd'?'selected':''}}>LED</option>
                        <option value="ess" {{old('department')=='csd'?'selected':''}}>ESS</option>
                        <option value="transport" {{old('department')=='csd'?'selected':''}}>Transport</option>
                    </select>
                   
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Email</label>
                    <input type="email" class="form-control  @error('email') is-invalid @enderror" 
                    placeholder="Enter Employee's Email" name="email" required 
                    value="{{old('email')}}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label>Contact</label>
                    <input type="text" class="form-control  @error('contact') is-invalid @enderror" 
                    placeholder="Enter Employee's Contact" name="contact" required 
                    value="{{old('contact')}}">
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
                    <input type="text" class="form-control  @error('address') is-invalid @enderror" 
                    id="exampleInputEmail" aria-describedby="emailHelp" 
                    placeholder="Enter Employee's Address" name="address" required value="{{old('address')}}">
                    @error('address')
                    <div class="invalid-feedback">
                    {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label>Position</label>
                    <input type="text" class="form-control  @error('role') is-invalid @enderror" 
                    placeholder="Enter Employee's Position" name="position" required 
                    value="{{old('position')}}">
                    @error('position')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn text-light btn-user btn-block"  style="background-color:cadetblue ;">
                Save
            </button>
            <hr>
        </form>
    </div>
</div>
@endsection