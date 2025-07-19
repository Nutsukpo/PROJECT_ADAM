@extends('layout.master')

@section('title','Add incomingletter')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <form class="incomingletters" action="{{route('incomingletters.create','fileupload.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <h5 class="text-dark">Adding Incomingletter </h5>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Letter Id</label>
                    <input type="text" class="form-control  @error('letter_id') is-invalid @enderror" 
                    placeholder="Enter letter_id" name="letter_id" required 
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
                    <label>To Whom Received</label>
                    <input type="text" class="form-control  @error('to_whom_received') is-invalid @enderror" 
                    placeholder="Enter letter_id" name="to_whom_received" required 
                    value="{{old('to_whom_received')}}">
                    @error('to_whom_received')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label>Date Of Letter</label>
                    <input type="date" class="form-control  @error('date_of_letter') is-invalid @enderror"
                    placeholder=" Enter date of letter" name="date_of_letter" required 
                    value="{{old('date_of_letter')}}">
                    @error('date_of_letter')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Sender</label>
                    <input type="text" class="form-control  @error('sender') is-invalid @enderror" 
                    placeholder="Enter letter_id" name="sender" required 
                    value="{{old('sender')}}">
                    @error('sender')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label>Mode Of Letter</label>
                    <input type="text" class="form-control  @error('date_of_letter') is-invalid @enderror"
                    placeholder=" Enter mode of letter" name="mode_of_letter" required 
                    value="{{old('mode_of_letter')}}">
                    @error('mode_of_letter')
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
            <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Name Of Person Receiving</label>
                    <input type="text" class="form-control  @error('name_of_person_receiving') is-invalid @enderror" 
                    placeholder="Enter name of person receiving" name="name_of_person_receiving" required 
                    value="{{old('name_of_person_receiving')}}">
                    @error('name_of_person_receiving')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Receiving Date</label>
                    <input type="date" class="form-control  @error('receiving_date') is-invalid @enderror" 
                    placeholder="Enter receiving date" name="receiving_date" required 
                    value="{{old('receiving_date')}}">
                    @error('description')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Upload Image</label><br>
                    <input type="file" name="file_path" id="file_path" >    
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