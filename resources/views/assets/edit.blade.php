@extends('layout.master')

@section('title','Edit Asset')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <form class="asset" action="/assets/{{$asset->id}}/update" method="POST">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Asset Id</label>
                    <input type="text" class="form-control form-control-user @error('asset_id') is-invalid @enderror"
                    placeholder="ID" name="asset_id" readonly  
                    value="{{$asset->asset_id}}">
                    @error('asset_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Asset Name</label>
                    <input type="text" class="form-control form-control-user @error('asset_name') is-invalid @enderror" 
                    placeholder="Enter First Name.." name="asset_name" required 
                    value="{{$asset->asset_name}}">
                    @error('asset_name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Department For</label>
                    <input type="text" class="form-control form-control-user @error('department_for') is-invalid @enderror" 
                    placeholder="Enter Department For" name="department_for" required 
                    value="{{$asset->department_for}}">
                    @error('department_for')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Assets Type</label>
                    <input type="text" class="form-control form-control-user @error('asset_type') is-invalid @enderror" 
                    placeholder="Enter Assets Type" name="asset_type" required 
                    value="{{$asset->asset_type}}">
                    @error('asset_type')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Serial Number</label>
                    <input type="text" class="form-control form-control-user @error('serial_number') is-invalid @enderror" 
                    placeholder="Enter Serial Number" name="serial_number" required 
                    value="{{$asset->serial_number}}">
                    @error('serial_number')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Asset Cost</label>
                    <input type="text" class="form-control form-control-user @error('asset_cost') is-invalid @enderror"  
                    placeholder="Enter Asset Cost" name="asset_cost" required value="{{$asset->asset_cost}}">
                    @error('asset_cost')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>   
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn text-light btn-user btn-block" style="background-color:cadetblue">
                Update
            </button>
            <hr>
        </form>
    </di>
</div>
@endsection