@extends('layout.master')

@section('title','Watch incomingletter')


@section('content')
<div>
    <h2 class="bg info">Details of incomingletter </h2>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>LETTER ID</label>
                    <h6>{{$incomingletters->letter_id}}</h6>
                </div>
                <div class="col-sm-6">
                    <label>REFERENCE NO:</label>
                    <h6></h6>
                    {{$incomingletters->reference_no}}
                    
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>TO WHOM RECEIVED:</label>
                    <h6>{{$incomingletters->to_whom_received}}</h6>
                </div>
                <div class="col-sm-6">
                    <label>DATE OF LETTER:</label>
                    <h6>{{$incomingletters->date_of_letter}}</h6>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>SENDER:</label>
                    <h6>{{$incomingletters->sender}}</h6>
                </div>
                <div class="col-sm-6">
                    <label>MODE OF LETTER:</label>
                    <h6>{{$incomingletters->mode_of_letter}}</h6>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>ORGANIZATION NAME:</label>
                    <h6>{{$incomingletters->organization_name}}</h6>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>DESCRIPTION:</label>
                    <h6>{{$incomingletters->description}}</h6>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>NAME OF PERSON RECEIVING:</label>
                    <h6>{{$incomingletters->name_of_person_receiving}}</h6>
                </div>
                <div class="col-sm-6">
                    <label>RECEIVING DATE:</label>
                    <h6>{{$incomingletters->receiving_date}}</h6>
                </div>
            </div>
            <!-- resources/views/incoming_letters/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Letter Details</title>
</head>
<body>
    <h2>PDF File:</h2>
    <embed src="{{ asset('storage/' . $incomingletters->file_path) }}" type="application/pdf" width="100%" height="600px" />

    <p><a href="{{ asset('storage/' . $incomingletters->file_path) }}" target="_blank">Download PDF</a></p>
</body>
</html>

    </div>
        <div class="col-lg-6 d-none d-lg-block bg-login-image img-fluid float-end">
            <img class="img-profile-small pt-5"style="size: 20px; width:100%" src="{{asset('img/officeassistant.png')}}">
        </div>
</div>
@endsection