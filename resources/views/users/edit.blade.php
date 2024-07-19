@extends('layout.master')

@section('title','Add user')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
    <form class="user" action="/users/{{$user->id}}/update" method="POST">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>full Name</label>
                    <input type="text" class="form-control  @error('name') is-invalid @enderror" 
                    placeholder="Enter Full Name.." name="name" required 
                    value="{{$user->name}}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label>Title</label>
                    <input type="text" class="form-control  @error('title') is-invalid @enderror"
                    placeholder="Enter Position" name="title" required 
                    value="{{$user->title}}">
                    @error('title')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div> 
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Email</label>
                    <input type="email" class="form-control  @error('email') is-invalid @enderror" 
                    placeholder="Enter Student's Email" name="email" required 
                    value="{{$user->email}}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>                
     
                <div class="col-sm-6">
                    <label>Contact</label>
                    <input type="text" class="form-control  @error('contact') is-invalid @enderror" 
                    placeholder="Enter user's Contact" name="contact" required 
                    value="{{$user->contact}}">
                    @error('contact')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn text-light btn-user btn-block" style="background-color:cadetblue">
                update
            </button>
            <hr>
        </form>
    </div>
</div>
@endsection