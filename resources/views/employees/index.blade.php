@extends('layout.master')

@section('title', 'Employee Management')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-dark">Staff Directory</h6>
            @can('createEmployee')
            <a href="/employees/create" class="btn btn-info btn-sm">
                <i class="fas fa-user-plus fa-sm mr-1"></i> Add Staff
            </a>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="employeesTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-light" style="background: cadetblue;">
                            <th>View</th>
                            <th>Staff ID</th>
                            <th>Full Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Address</th>
                            <th>Position</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                            <tr>
                                <td>
                                    <a href="/employees/{{ $employee->id }}/watch" class="btn btn-sm btn-circle btn-info"
                                       title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td>{{ $employee->employee_id }}</td>
                                <td>{{ ucfirst($employee->firstname) }} {{ ucfirst($employee->lastname) }}</td>
                                <td>{{ $employee->contact }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ ucfirst($employee->department) }}</td>
                                <td>{{ $employee->address }}</td>
                                <td>{{ $employee->position }}</td>
                                <td>
                                    <div class="d-flex">
                                        @can('editEmployee')
                                        <a href="/employees/{{ $employee->id }}/edit" 
                                           class="btn btn-sm btn-circle btn-info mr-2"
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endcan
                                       
                                        <button class="btn btn-sm btn-circle btn-danger delete-btn"
                                                data-toggle="modal"
                                                data-target="#deleteModal"
                                                data-id="{{ $employee->id }}"
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                       
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">No employees found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteForm" method="POST">
                @csrf
                <div class="modal-body">
                    <p>Are you sure you want to delete this employee?</p>
                    <p class="text-danger">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .btn-circle {
        width: 30px;
        height: 30px;
        padding: 6px 0;
        border-radius: 15px;
        text-align: center;
        font-size: 12px;
        line-height: 1.42857;
    }
    #employeesTable tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
    }
    .table thead th {
        vertical-align: middle;
    }
    .table td {
        vertical-align: middle;
    }
</style>
@endsection

@section('scripts')
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable with basic features
    var table = $('#employeesTable').DataTable({
        responsive: true,
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search employees...",
            lengthMenu: "Show _MENU_ employees",
            info: "Showing _START_ to _END_ of _TOTAL_ employees",
            infoEmpty: "No employees available",
        },
        columnDefs: [
            { orderable: false, targets: [0, 8] } // Disable sorting for action columns
        ]
    });

    // Handle delete button click to set proper form action
    $('.delete-btn').click(function() {
        var employeeId = $(this).data('id');
        $('#deleteForm').attr('action', '/employees/' + employeeId);
    });
});
</script>
@endsection