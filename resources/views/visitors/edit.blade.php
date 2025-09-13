@extends('layout.master')

@section('title', 'Edit Visitor')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-dark">Edit Visitor Information</h6>
        </div>
        <div class="card-body">
            <form action="/visitors/{{$visitor->id}}/update" method="POST" class="needs-validation" novalidate>
                @csrf
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="visitor_name" class="font-weight-bold text-dark">Client Name</label>
                            <input type="text" class="form-control @error('visitor_name') is-invalid @enderror"
                                   id="visitor_name" name="visitor_name" placeholder="Enter client name" 
                                   value="{{ old('visitor_name', $visitor->visitor_name) }}" required>
                            @error('visitor_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="contact" class="font-weight-bold text-dark">Contact</label>
                            <input type="text" class="form-control @error('contact') is-invalid @enderror" 
                                   id="contact" name="contact" placeholder="Enter contact number"
                                   value="{{ old('contact', $visitor->contact) }}" required>
                            @error('contact')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="purpose_of_visit" class="font-weight-bold text-dark">Agenda</label>
                            <input type="text" class="form-control @error('purpose_of_visit') is-invalid @enderror" 
                                   id="purpose_of_visit" name="purpose_of_visit" placeholder="Purpose of visit"
                                   value="{{ old('purpose_of_visit', $visitor->purpose_of_visit) }}" required>
                            @error('purpose_of_visit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="department" class="font-weight-bold text-dark">Department</label>
                            <input type="text" class="form-control @error('department') is-invalid @enderror" 
                                   id="department" name="department" placeholder="Enter department"
                                   value="{{ old('department', $visitor->department) }}" required>
                            @error('department')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gender" class="font-weight-bold text-dark">Gender</label>
                            <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                                <option value="">Select Gender</option>
                                <option value="Male" {{ (old('gender', $visitor->gender) == 'Male') ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ (old('gender', $visitor->gender) == 'Female') ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ (old('gender', $visitor->gender) == 'Other') ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="vulnerability" class="font-weight-bold text-dark">Vulnerability</label>
                            <select class="form-control @error('vulnerability') is-invalid @enderror" id="vulnerability" name="vulnerability" required>
                                <option value="">Select Vulnerability Status</option>
                                <option value="High" {{ (old('vulnerability', $visitor->vulnerability) == 'High') ? 'selected' : '' }}>High</option>
                                <option value="Medium" {{ (old('vulnerability', $visitor->vulnerability) == 'Medium') ? 'selected' : '' }}>Medium</option>
                                <option value="Low" {{ (old('vulnerability', $visitor->vulnerability) == 'Low') ? 'selected' : '' }}>Low</option>
                                <option value="None" {{ (old('vulnerability', $visitor->vulnerability) == 'None') ? 'selected' : '' }}>None</option>
                            </select>
                            @error('vulnerability')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="visiting_date" class="font-weight-bold text-dark">Date</label>
                            <input type="date" class="form-control @error('visiting_date') is-invalid @enderror" 
                                   id="visiting_date" name="visiting_date"
                                   value="{{ old('visiting_date', $visitor->visiting_date) }}">
                            @error('visiting_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="time_in" class="font-weight-bold text-dark">Arrival</label>
                            <input type="time" class="form-control @error('time_in') is-invalid @enderror" 
                                   id="time_in" name="time_in" placeholder="Arrival time"
                                   value="{{ old('time_in', $visitor->time_in) }}" required>
                            @error('time_in')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="time_out" class="font-weight-bold text-dark">Departure</label>
                            <input type="time" class="form-control @error('time_out') is-invalid @enderror" 
                                   id="time_out" name="time_out" placeholder="Departure time"
                                   value="{{ old('time_out', $visitor->time_out) }}">
                            @error('time_out')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <div class="col-md-12 d-flex justify-content-between">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>Back
                        </a>
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-save mr-2"></i>Update Visitor
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        border-radius: 0.35rem;
        border: none;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }
    .card-header {
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
    }
    .form-control {
        border-radius: 0.35rem;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d3e2;
    }
    .form-control:focus {
        border-color: #bac8f3;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    .btn-primary {
        background-color: #4e73df;
        border-color: #4e73df;
    }
    .btn-primary:hover {
        background-color: #2e59d9;
        border-color: #2653d4;
    }
    .invalid-feedback {
        font-size: 0.85rem;
    }
    label {
        color: #5a5c69;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05rem;
    }
</style>
@endsection