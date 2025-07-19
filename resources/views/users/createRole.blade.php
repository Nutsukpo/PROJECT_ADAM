@extends('layout.master')

@section('title','Add Role')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <form class="user" action="{{route('role.create')}}" method="POST">
            @csrf
            <div>
                <h5 class="text-dark">Adding Role </h5>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-sm-12 mb-3 mb-sm-0">
                    <label>Role Name</label>
                    <input type="text" class="form-control  @error('name') is-invalid @enderror" 
                    placeholder="Enter Role Name.." name="name" required 
                    value="{{old('name')}}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label>Assign Permissions</label>
                <div class="row">
                    @foreach($permissions as $permission)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input"
                                    type="checkbox"
                                    name="permissions[]"
                                    id="perm_{{ $permission->id }}"
                                    value="{{ $permission->name }}">
                                <label class="form-check-label" for="perm_{{ $permission->id }}">
                                    {{ ucwords(str_replace('_', ' ', $permission->name)) }}
                                </label>
                            </div>
                        </div>
                    @endforeach
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