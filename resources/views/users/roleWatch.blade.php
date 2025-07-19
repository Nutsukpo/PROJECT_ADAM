@extends('layout.master')
@extends('layout.header')


@section('title','View Role')

@section('content')
<div>
    <h2 class="bg info">Role Details </h2>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
    <form class="user" action="/users/{{$role->id}}/update" method="POST">
            @csrf
            
            <div class="form-group row">
                <div class="col-sm-12 mb-3 mb-sm-0">
                    <label>Role Name</label>
                    <input type="text" class="form-control  @error('name') is-invalid @enderror" 
                    placeholder="Enter Role Name.." name="name"  disabled  
                    value="{{old('name',$role->name)}}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
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
                                       {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}>
                                <label for="perm_{{ $permission->id }}" class="form-check-label">
                                    {{ ucwords(str_replace('_', ' ', $permission->name)) }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr>   
        </form>
    </div>
</div>

@endsection