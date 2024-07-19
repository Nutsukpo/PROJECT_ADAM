@extends('layout.master')

@section('title','view outgoingletters')

@section('content')
<div>
    <h2 class="bg info">Details of outgoingletter </h2>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form class="outgoingletters text-dark" action="/outgoingletters/{{$outgoingletters->id}}/update" method="POST">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>LETTER ID:</label>
                    <h5>{{$outgoingletters->letter_id}}</h5>
                </div>
                <div class="col-sm-6">
                    <label>REFERENCE NO:</label>   
                    <h5>{{$outgoingletters->reference_no}}</h5>   
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>ORGANIZATION NAME:</label>
                    <h5>{{$outgoingletters->organization_name}}</h5>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>DESCRIPTION: </label>
                    <H5>{{$outgoingletters->description}}</H5>   
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 ">
                    <label>SENDING DATE:</label>
                    <h5>{{$outgoingletters->sending_date}}</h5>   
                </div>
            </div> 
        </form>
            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                <img class="img-profile-small pt-5"style="size: 80px; width:100%" src="{{asset('img/officeassistant.png')}}">
            </div>
    </div>
</div>
@endsection