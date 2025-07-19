@extends('layout.master')

@section('title','view visitor')

@section('content')
<div>
    <h2 class="bg info">Client Details </h2>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form class="visitor" action="/visitors/{{$visitor->id}}/update" method="POST">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6">
                    <label>Client Name</label>
                    <input type="text" class="form-control  @error('visitor_name') is-invalid @enderror" disabled
                    placeholder="Enter client name" name="visitor_name" required 
                    value="{{$visitor->visitor_name}}"> 
                </div>
                <div class="col-sm-6">
                    <label>Agenda</label>
                    <input type="text" class="form-control  @error('purpose_of_visit') is-invalid @enderror" disabled
                    placeholder="purpose of visit" name="purpose_of_visit" required 
                    value="{{$visitor->purpose_of_visit}}">
                    @error('purpose_of_visit')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Contact</label>
                    <input type="text" class="form-control  @error('contact') is-invalid @enderror" 
                    placeholder="Enter contact" name="contact" required disabled
                    value="{{$visitor->contact}}">
                    @error('contact')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Department</label>
                    <input type="department" class="form-control  @error('department') is-invalid @enderror" 
                    placeholder="Enter department" name="department" required disabled
                    value="{{$visitor->department}}">
                    @error('department')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label>Gender</label>
                    <input type="text" class="form-control  @error('gender') is-invalid @enderror" 
                    placeholder="Enter vulnerability" name="gender" disabled
                    value="{{$visitor->gender}}">
                    @error('gender')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Vulnerability</label>
                    <input type="text" class="form-control  @error('vulnerability') is-invalid @enderror" 
                    placeholder="Enter vulnerability" name="vulnerability" disabled
                    value="{{$visitor->vulnerability}}">
                    @error('vulnerability')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Arrival</label>
                    <input type="time" class="form-control  @error('time_in') is-invalid @enderror" 
                    placeholder="Enter time_in" name="time_in" required disabled
                    value="{{$visitor->time_in}}">
                    @error('time_in')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label>Departure</label>
                    <input type="time" class="form-control  @error('time_out') is-invalid @enderror" 
                    placeholder="time_out" name="time_out" disabled
                    value="{{$visitor->time_out}}">
                    @error('time_out')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>    
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label>Date</label>
                    <input type="date" class="form-control  @error('visiting_date') is-invalid @enderror" 
                    placeholder="date" name="visiting_date" disabled
                    value="{{$visitor->visiting_date}}">
                    @error('visiting_date')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
                
        </form>
    </div>
    
</div>
@endsection


                    