@extends('layout.master')

@section('title', 'Attendance Details')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Attendance Details</h6>
        <a href="{{ route('attendance.index') }}" class="btn btn-sm btn-secondary">Back to List</a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Employee Name:</label>
                    <p class="form-control-plaintext">{{ $attendance->employee_name }}</p>
                </div>
                <div class="form-group">
                    <label>Date:</label>
                    <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}</p>
                </div>
                <div class="form-group">
                    <label>Status:</label>
                    <p class="form-control-plaintext">
                        <span class="badge badge-{{ 
                            $attendance->status == 'present' ? 'success' : 
                            ($attendance->status == 'absent' ? 'danger' : 
                            ($attendance->status == 'late' ? 'warning' : 'info'))
                        }}">
                            {{ ucfirst($attendance->status) }}
                        </span>
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Clock In:</label>
                    <p class="form-control-plaintext">
                        {{ $attendance->clock_in ? \Carbon\Carbon::parse($attendance->clock_in)->format('h:i A') : '--' }}
                    </p>
                </div>
                <div class="form-group">
                    <label>Clock Out:</label>
                    <p class="form-control-plaintext">
                        {{ $attendance->clock_out ? \Carbon\Carbon::parse($attendance->clock_out)->format('h:i A') : '--' }}
                    </p>
                </div>
                <div class="form-group">
                    <label>Notes:</label>
                    <p class="form-control-plaintext">{{ $attendance->notes ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
        
        <div class="mt-4">
            <a href="{{ route('attendance.edit', $attendance->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('attendance.destroy', $attendance->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection