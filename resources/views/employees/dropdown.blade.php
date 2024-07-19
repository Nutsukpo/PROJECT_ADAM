@extends('layout.master')

@section('title','Add Employee')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Employee Dropdown</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Select an Employee</h1>
    <form action="#" method="POST">
        @csrf
        <div class="form-group">
            <label for="employee_id">Employee:</label>
            <select name="employee_id" id="employee_id" class="form-control">
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>









@endsection