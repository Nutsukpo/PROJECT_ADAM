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
                    <label>Select Staff</label>
                    <select>
                        <option>
                        <input type="text" class="form-control  @error('department_for') is-invalid @enderror" 
                    placeholder="Enter department for" name="department_for" required 
                    value="{{old('department_for')}}">
                    @error('department_for')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                        </option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label>attendance Date</label>
                    <input type="date" class="form-control  @error('asset_name') is-invalid @enderror"
                    placeholder="Enter Last Name" name="asset_name" required 
                    value="{{old('asset_name')}}">
                    @error('asset_name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Department_For</label>
                    <input type="text" class="form-control  @error('department_for') is-invalid @enderror" 
                    placeholder="Enter department for" name="department_for" required 
                    value="{{old('department_for')}}">
                    @error('department_for')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Clock-In</label>
                    <input type="assets_type" class="form-control  @error('asset_type') is-invalid @enderror" 
                    placeholder="Enter Asset Type" name="asset_type" required 
                    value="{{old('asset_type')}}">
                    @error('asset_type')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-user text-light btn-block" style="background-color: cadetblue;">
                Save
            </button>
            <hr>
        </form>
    </div>
</div>
@endsection