@extends('layout.master')
@extends('layout.header')


@section('title','Add user')

@section('content')
<div>
    <h2 class="bg info">Details of User </h2>
</div>
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
<div class="form-group row">
    <div class="col-sm-12 mb-3 mb-sm-0">
        <label>Assigned Role</label>
        <input type="text" class="form-control  @error('name') is-invalid @enderror" 
        placeholder="Enter Role Name.." name="name"  disabled  
        value="{{ $user->roles->first()->name ?? '' }}">
                    
    </div>
</div>
<div class="form-group row">
                <label>Assigned Permissions</label>
                <div class="row">
                    @foreach($permissions as $permission)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox"
                                       name="permissions[]"
                                       value="{{ $permission->name }}"
                                       id="perm_{{ $permission->id }}"
                                       disabled
                                       class="form-check-input"
                                       {{ $user->permissions->pluck('id')->contains($permission->id) ? 'checked' : '' }}>
                                <label for="perm_{{ $permission->id }}" class="form-check-label">
                                    {{ ucwords(str_replace('_', ' ', $permission->name)) }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
@endsection