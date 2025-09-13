@extends('layout.master')

@section('title', 'Attendance List')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-dark">Attendance List</h6>
        <a href="{{ route('attendance.create') }}" class="btn btn-sm btn-info">
            <i class="fas fa-plus"></i> Add Attendance
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-white" style="background-color: cadetblue;">
                        <th>Action</th>
                        <th>Staff Name</th>
                        <th>Clock In</th>
                        <th>Clock Out</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendance as $record)
                    <tr>
                        <td>
                            <a href="{{ route('attendance.show', $record->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('attendance.edit', $record->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </td>
                        <td>{{ $record->employee_name }}</td>
                        <td>{{ $record->clock_in ? \Carbon\Carbon::parse($record->clock_in)->format('h:i A') : '--' }}</td>
                        <td>{{ $record->clock_out ? \Carbon\Carbon::parse($record->clock_out)->format('h:i A') : '--' }}</td>
                        <td>
                            <span class="badge badge-{{ 
                                $record->status == 'present' ? 'success' : 
                                ($record->status == 'absent' ? 'danger' : 
                                ($record->status == 'late' ? 'warning' : 'info'))
                            }}">
                                {{ ucfirst($record->status) }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($record->date)->format('M d, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        "order": [[5, "desc"]]
    });
});
</script>
@endsection