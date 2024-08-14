@extends('layout.master')

@section('title','Add attendance')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <form class="attendance" action="{{route('attendance.create')}}" method="POST">
            @csrf
            <div>
                <h5 class="text-dark">Adding Attendance </h5>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Name Of Employee</label>  
                    <select type="text" class="form-control  @error('name_of_employee') is-invalid @enderror" 
                    placeholder="Enter name of employee" name="name_of_employee"  id="employee_id" required >
                        <option value="">Select Staff</option>
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
                <div class="col-sm-6">
                    <label>attendance Date</label>
                    <input type="date" class="form-control  @error('attendance_date') is-invalid @enderror"
                    placeholder="Enter Last Name" name="attendance_date" required 
                    value="{{old('attendance_date')}}">
                    @error('attendance_date')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label>Clock-In</label>
                    <select class="form-control" name="clock_in" >
                        <option value="">Select Status</option>
                        <option value="present" {{old('present')=='csd'?'selected':''}}>Present</option>
                        <option value="absent" {{old('absent')=='csd'?'selected':''}}>Absent</option>
                    </select>       
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Time</label>
                    <input type="time" class="form-control  @error('time') is-invalid @enderror" 
                     name="time" required 
                    value="{{old('time')}}">
                    @error('time')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-user text-light btn-block" style="background-color: cadetblue;">
                Clock-In
            </button>
            <hr>
        </form>
    </div>
</div>
@endsection