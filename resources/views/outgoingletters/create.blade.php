@extends('layout.master')

@section('title','Add outgoingletter')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <form class="outgoingletters" action="{{route('outgoingletters.create')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <h5 class="text-dark">Adding outgoingletter </h5>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Letter Id</label>
                    <input type="text" class="form-control  @error('letter_id') is-invalid @enderror" 
                    placeholder="ID" name="letter_id" readonly 
                    value="{{old('letter_id')}}">
                    @error('letter_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label>Reference No</label>
                    <input type="text" class="form-control  @error('lastname') is-invalid @enderror"
                    placeholder="Enter Last Name" name="reference_no" required 
                    value="{{old('reference_no')}}">
                    @error('reference_no')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Organization Name</label>
                    <input type="text" class="form-control  @error('organization_name') is-invalid @enderror" 
                    placeholder="Enter organization_name" name="organization_name" required 
                    value="{{old('organization_name')}}">
                    @error('organization_name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Description</label>
                    <input type="text" class="form-control  @error('description') is-invalid @enderror" 
                    placeholder="Enter Letter description" name="description" required 
                    value="{{old('description')}}">
                    @error('description')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label>Sending Date</label>
                <input type="date" class="form-control  @error('sending_date') is-invalid @enderror" 
                placeholder="Enter sending date" name="sending_date" required value="{{old('sending_date')}}">
                @error('sending_date')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Upload Image</label><br>
                    <input type="file" name="file_path" id="file_path" >    
                </div>
            </div>
            <button type="submit" class="btn text-light btn-user btn-block" style="background-color:cadetblue">
                Save
            </button>
            <hr>
        </form>
    </div>
</div>
@endsection