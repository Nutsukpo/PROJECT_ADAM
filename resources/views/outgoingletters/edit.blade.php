@extends('layout.master')

@section('title','Edit outgoingletter')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <form class="outgoingletters" action="/outgoingletters/{{$outgoingletters->id}}/update" method="POST">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Letter ID</label>
                    <input type="text" class="form-control form-control-user @error('letter_id') is-invalid @enderror" 
                    placeholder="Enter Letter ID" name="letter_id" readonly 
                    value="{{$outgoingletters->letter_id}}">
                    @error('letter_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label>reference_no</label>
                    <input type="text" class="form-control form-control-user @error('reference_no') is-invalid @enderror"
                    placeholder="Enter Last Name" name="reference_no"  
                    value="{{$outgoingletters->reference_no}}">
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
                    <input type="text" class="form-control form-control-user @error('student_id') is-invalid @enderror" 
                    placeholder="Enter organization_name" name="organization_name" 
                    value="{{$outgoingletters->organization_name}}">
                    @error('organization_name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Description</label>
                    <input type="text" class="form-control form-control-user @error('email') is-invalid @enderror" 
                    placeholder="Enter description" name="description"  
                    value="{{$outgoingletters->description}}">
                    @error('description')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label>Sending Date</label>
                    <input type="date" class="form-control form-control-user @error('contact') is-invalid @enderror" 
                    placeholder="Enter sending_date" name="sending_date"  
                    value="{{$outgoingletters->sending_date}}">
                    @error('sending_date')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
                <button type="submit" class="btn btn-user text-light btn-block" style="background-color: cadetblue;">
                Update
                </button>
            
        </form>
    </div>
</div>
@endsection