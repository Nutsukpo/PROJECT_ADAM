@extends('layout.master')

@section('title', 'Employee Details')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Staff Details</h1>
        <div>
            <a href="/employees" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left fa-sm"></i> Back to List
            </a>
            @can('editEmployee')
            <a href="/employees/{{$employee->id}}/edit" class="btn btn-info btn-sm">
                <i class="fas fa-edit fa-sm"></i> Edit Profile
            </a>
            @endcan
        </div>
    </div>

    <!-- Employee Details Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 " style="background-color: cadetblue;">
            <h6 class="m-0 font-weight-bold text-white">
                {{ $employee->firstname }} {{ $employee->lastname }} - {{ $employee->employee_id }}
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Personal Info Column -->
                <div class="col-lg-4">
                    <div class="card mb-4 border-left-info">
                        <div class="card-header py-3 bg-light">
                            <h6 class="m-0 font-weight-bold text-info">Personal Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="small font-weight-bold text-gray-600">Full Name</label>
                                <p class="font-weight-bold">{{ $employee->firstname }} {{ $employee->lastname }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="small font-weight-bold text-gray-600">Staff ID</label>
                                <p class="font-weight-bold">{{ $employee->employee_id }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="small font-weight-bold text-gray-600">Position</label>
                                <p class="font-weight-bold">{{ $employee->position }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="small font-weight-bold text-gray-600">Department</label>
                                <p class="font-weight-bold">{{ $employee->department }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Info Column -->
                <div class="col-lg-4">
                    <div class="card mb-4 border-left-info">
                        <div class="card-header py-3 bg-light">
                            <h6 class="m-0 font-weight-bold text-info">Contact Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="small font-weight-bold text-gray-600">Email Address</label>
                                <p class="font-weight-bold">{{ $employee->email }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="small font-weight-bold text-gray-600">Phone Number</label>
                                <p class="font-weight-bold">{{ $employee->contact }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="small font-weight-bold text-gray-600">Physical Address</label>
                                <p class="font-weight-bold">{{ $employee->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Photo Column -->
                <div class="col-lg-4">
                    <div class="card mb-4 border-left-info">
                        <div class="card-header py-3 bg-light">
                            <h6 class="m-0 font-weight-bold text-info">Staff Photo</h6>
                        </div>
                        <div class="card-body text-center">
                            @if($employee->picture)
                            <img class="img-profile rounded-circle mb-3" 
                                 style="width: 300px; height: 400px; object-fit: cover;"
                                 src="{{ asset('storage/'.$employee->picture) }}" 
                                 alt="{{ $employee->firstname }} {{ $employee->lastname }}"
                                 title="{{ $employee->firstname }} {{ $employee->lastname }} | {{ $employee->position }}">
                            @else
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 200px; height: 200px; margin: 0 auto;">
                                <i class="fas fa-user fa-4x text-gray-400"></i>
                            </div>
                            @endif
                            <div class="mt-3">
                                <span class="badge badge-info p-2">{{ $employee->position }}</span>
                                <!-- <span class="badge badge-info p-2">{{ $employee->department }}</span> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Sections (if needed) -->
            <div class="row">
                <!-- You can add more sections here like employment history, documents, etc. -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .img-profile {
        border: 3px solid #ddd;
        transition: all 0.3s;
    }
    .img-profile:hover {
        transform: scale(1.05);
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,.125);
    }
    .small {
        font-size: 0.875rem;
    }
</style>
@endsection