@extends('layout.master')

@section('title','Add user')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <form class="user" action="{{route('user.create')}}" method="POST">
            @csrf
            <div>
                <h5 class="text-dark">Adding User </h5>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>full Name</label>
                    <input type="text" class="form-control  @error('name') is-invalid @enderror" 
                    placeholder="Enter Full Name.." name="name" required 
                    value="{{old('name')}}">
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
                    value="{{old('title')}}">
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
                    placeholder="Enter user's Email" name="email" required 
                    value="{{old('email')}}">
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
                    value="{{old('contact')}}">
                    @error('contact')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-6 ">
                    <label>Passowrd</label>
                    <input type="password" class="form-control  @error('password') is-invalid @enderror" 
                    placeholder="Enter User Password" name="password" required 
                    value="{{old('password')}}">
                    @error('password')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>    
          
                <div class="col-sm-6 ">
                    <label>Confirm Passowrd</label>
                    <input type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" 
                    placeholder="Confirm Password" name="password_confirmation" required>
                    @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div> 
            </div> 
            <div class="form-group row">
          
                <div class="col-sm-6 ">
                    <label>Role</label>
                    <select class="form-control" name="role" >
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{$role->id}}" {{old('role')=='csd'?'selected':''}}>{{ $role->name }}</option>
                        @endforeach
                        <!-- <option value="coordinator" {{old('department')=='csd'?'selected':''}}>Coordinator</option> -->
                        
                    </select>
                    @error('role')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div> 
            </div>  
            <button type="submit" class="btn text-light btn-block" style="background-color:cadetblue">
                Save
            </button>
            <hr>
        </form>
    </div>
</div>
@endsection