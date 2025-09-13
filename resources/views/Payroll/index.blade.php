@extends('layout.master')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-info">Payroll Records</h6>
            <a href="{{ route('payroll.create') }}" class="btn btn-info btn-sm">
                <i class="fas fa-plus"></i> Create New Payroll
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-light" style="background-color: cadetblue;">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Period</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Status</th>
                            <th>Employees</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payrolls as $payroll)
                        <tr>
                            <td>{{ $payroll->id }}</td>
                            <td>{{ $payroll->title }}</td>
                            <td>{{ $payroll->period_start->format('M d') }} - {{ $payroll->period_end->format('M d, Y') }}</td>
                            <td>{{ $payroll->period_start }}</td>
                            <td>{{ $payroll->period_start }}</td>
                            <td><span class="badge badge-{{ $payroll->status_color }}">{{ ucfirst($payroll->status) }}</span></td>
                            <td>{{ $payroll->items->count() }}</td>
                            <td>
                                <a href="{{ route('payroll.show', $payroll) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection