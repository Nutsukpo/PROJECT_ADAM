@extends('layout.master')

@section('title','Edit Asset')

@section('content')
<div>
    <h2 class="bg info">Details of Asset </h2>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form class="asset" action="/asset/{{$asset->id}}/update" method="POST">
            @csrf
            
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>ASSET ID:</label>
                    <h6>{{$asset->asset_id}}</h6>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Asset Name: </label>
                    <h6> {{$asset->asset_name}}</h6>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>DEPARTMENT FOR: </label>
                    <h6>{{$asset->department_for}}</h6>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>ASSET TYPE: </label>
                    <h6>{{$asset->asset_type}}</h6>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>SERIAL NUMBER: </label>
                    <h6>{{$asset->serial_number}}</h6>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>ASSET COST: </label>
                    <h6>{{$asset->asset_cost}}</h6>
                </div>
            
        </form>
    </div>
        <div class="col-lg-6 d-none d-lg-block bg-login-image">
            <img class="img-profile-small pt-5"style="size: 20px; width:100%" src="{{asset('img/officeassistant.png')}}">
        </div>
</div>
@endsection