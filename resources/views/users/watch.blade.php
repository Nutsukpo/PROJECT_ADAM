@extends('layout.master')
@extends('layout.header')


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
                    placeholder="Enter Full Name.." name="name "disabled required 
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
                    placeholder="Enter Position" name="title"disabled required 
                    value="{{$user->title}}">
                </div> 
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Email</label>
                    <input type="email" class="form-control  @error('email') is-invalid @enderror" 
                    placeholder="Enter Student's Email" name="email"disabled required 
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
                    placeholder="Enter user's Contact" name="contact"disabled required 
                    value="{{$user->contact}}">
                    @error('contact')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <hr>   
        </form>
    </div>
</div>
<div>
    <div class="card shadow mb-4">
            <h4 class="items-flex">OTHER DETAILS OF THIS USER WILL BE SHOWN HERE</h4>
    </div>
</div>
@endsection