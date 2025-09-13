@extends('layout.master')

@section('title', 'Add Attendance')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('attendance.store') }}" method="POST">
            @csrf
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="text-dark">Attendance Record</h5>
                <a href="{{ route('attendance.index') }}" class="btn btn-sm btn-secondary">Back to List</a>
            </div>
            <hr>
            
            <div class="form-group row">
                <div class="col-md-6 mb-3">
                    <label for="employee_id">Employee</label>  
                    <select class="form-control @error('employee_id') is-invalid @enderror" 
                            name="employee_id" id="employee_id" required>
                        <option value="">Select Employee</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}" 
                                {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                {{ $employee->firstname }} {{ $employee->lastname }}
                            </option>
                        @endforeach
                    </select>
                    @error('employee_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="date">Attendance Date</label>
                    <input type="date" class="form-control @error('date') is-invalid @enderror"
                           name="date" id="date" required 
                           value="{{ old('date', date('Y-m-d')) }}">
                    @error('date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-md-6 mb-3">
                    <label for="clock_in">Clock-In Time</label>
                    <input type="time" class="form-control @error('clock_in') is-invalid @enderror" 
                           name="clock_in" id="clock_in" required 
                           value="{{ old('clock_in', date('H:i')) }}">
                    @error('clock_in')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="clock_out">Clock-Out Time</label>
                    <input type="time" class="form-control @error('clock_out') is-invalid @enderror"
                           name="clock_out" id="clock_out" 
                           value="{{ old('clock_out') }}">
                    @error('clock_out')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-md-6 mb-3">
                    <label for="status">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                        <option value="present" {{ old('status') == 'present' ? 'selected' : '' }}>Present</option>
                        <option value="absent" {{ old('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                        <option value="late" {{ old('status') == 'late' ? 'selected' : '' }}>Late</option>
                        <option value="half_day" {{ old('status') == 'half_day' ? 'selected' : '' }}>Half Day</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror       
                </div>
                <div class="col-md-6 mb-3">
                    <label for="notes">Notes</label>
                    <input type="text" class="form-control @error('notes') is-invalid @enderror" 
                           name="notes" id="notes" placeholder="Optional notes"
                           value="{{ old('notes') }}">
                    @error('notes')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row mt-4">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-save"></i> Save Attendance
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

