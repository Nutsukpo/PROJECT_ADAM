@extends('layout.master')

@section('title','Add Employee')

@section('content')
<div class="card shadow mb-1">
    <div class="card-header py-3">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h6 class="h3 mb-0 text-dark">Employee List</h6>
            <h6 class="m-0 font-weight-bold text-info">
            @can('createEmployee')
            <a class="m-0 font-weight-bold text-info" style="text-decoration: dotted;" href="/employees/create">Add Employee</a>
            @endcan
            </h6> 
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered text-4xl" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr class="text-light" style="background: cadetblue;">
                    <th>Action</th>
                    <th>Staff ID</th>
                    <th>Full Name</th>
                    <th>Contact</th>
                    <th>Email Address</th>
                    <th>Department</th>
                    <th>Address</th>
                    <th>Position</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $employee)
                    <tr>
                        <td>
                            <a style="text-decoration:none" href="/employees/{{ $employee->id }}/watch">
                                <i class="text-info">view</i>
                            </a>
                        </td>
                        <td class="text-small text-bold">{{ ucfirst($employee->employee_id)}}</td>
                        <td class="text-bold text-small">{{ ucfirst($employee->firstname) }} {{ ucfirst($employee->lastname) }}</td>
                        <td class="text-bold text-small">{{ $employee->contact }}</td>
                        <td class="text-bold text-small">{{ $employee->email }}</td>
                        <td class="text-bold text-small">{{ ucfirst($employee->department) }}</td>
                        <td class="text-bold text-small">{{ $employee->address }}</td>
                        <td class="text-bold text-small">{{ $employee->position }}</td>
                        <td>
                            @can('editEmployee')
                            <a href="/employees/{{ $employee->id }}/edit" class="btn btn-info btn-small"></a>
                            @endcan
                            @can('deleteEmployee')
                            <button class="btn btn-danger btn-small"
                                    data-toggle="modal"
                                    data-target="#deleteModal"
                                    data-id="{{ $employee->id }}">
                                <!-- Delete -->
                            </button>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <!-- <td colspan="9" class="text-center text-muted">No employees found.</td> -->
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="deleteForm" method="POST">
            @csrf
            <!-- @method('DELETE') -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Action?</h5>
                    <button class="close" type="button" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this employee?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info" type="button" data-dismiss="modal">cancel</button>
                    <button class="btn btn-danger" type="submit">delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    $('#deleteModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let employeeId = button.data('id');
        let form = $('#deleteForm');
        form.attr('action', '/employees/' + employeeId + '/delete');
    });
    
</script>
@endsection
