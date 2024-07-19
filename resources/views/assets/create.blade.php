@extends('layout.master')

@section('title','Add Asset')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <form class="assets" action="{{route('asset.create')}}" method="POST">
            @csrf
            <div>
                <h5 class="text-dark">Adding Asset </h5>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Asset Id</label>
                    <input type="text" class="form-control  @error('asset_id') is-invalid @enderror" 
                    placeholder="Enter Asset Id" name="asset_id" required 
                    value="{{old('assets_id')}}">
                    @error('assets_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label>Asset Name</label>
                    <input type="text" class="form-control  @error('asset_name') is-invalid @enderror"
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
                    <label>Asset Type</label>
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
            <div class="form-group row">
                <div class="col-sm-6">
                    <label>Serial Number</label>
                    <input type="text" class="form-control  @error('serial_number') is-invalid @enderror" 
                    placeholder="Enter Serial Number" name="serial_number" required 
                    value="{{old('serial_number')}}">
                    @error('serial_number')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Asset Cost</label>
                    <input type="text" class="form-control  @error('asset_cost') is-invalid @enderror" 
                    placeholder="Enter Asset Cost" name="asset_cost" required value="{{old('asset_cost')}}">
                    @error('asset_cost')
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