@extends('layout.master')

@section('title', 'Visitors List')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-users me-2"></i>Visitors Log
            </h5>
            <a href="{{ route('visitors.create') }}" class="btn btn-info btn-sm">
                <i class="fas fa-plus me-1"></i> Add Visitor
            </a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table id="visitorsTable" class="table table-hover table-sm">
                    <thead class="text-light" style="background-color: cadetblue;">
                        <tr>
                            <th>#</th>
                            <th>Client Name</th>
                            <th>Contact</th>
                            <th>Department</th>
                            <th>Purpose</th>
                            <th>Arrival</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visitors as $visitor)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $visitor->visitor_name }}</td>
                            <td>{{ $visitor->contact }}</td>
                            <td>{{ $visitor->department }}</td>
                            <td>{{ Str::limit($visitor->purpose_of_visit, 20) }}</td>
                            <td>{{ $visitor->time_in }}</td>
                            <td>{{ \Carbon\Carbon::parse($visitor->visiting_date)->format('d M Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="/visitors/{{ $visitor->id }}/watch" class="btn btn-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="/visitors/{{ $visitor->id }}/edit" class="btn btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger delete-visitor" 
                                            data-id="{{ $visitor->id }}"
                                            data-name="{{ $visitor->visitor_name }}"
                                            title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete visitor <strong id="visitorName"></strong>?</p>
                <p class="text-danger">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#visitorsTable').DataTable({
        responsive: true,
        columnDefs: [
            { orderable: false, targets: [7] }
        ]
    });

    // Delete confirmation modal
    $('.delete-visitor').on('click', function() {
        const visitorId = $(this).data('id');
        const visitorName = $(this).data('name');
        const form = $('#deleteForm');
        
        $('#visitorName').text(visitorName);
        form.attr('action', `/visitors/${visitorId}/delete`);
        $('#deleteModal').modal('show');
    });
});
</script>
@endsection

@section('styles')
<style>
    #visitorsTable {
        font-size: 0.875rem;
    }
    .table-light th {
        background-color: #f8f9fa;
    }
    .btn-group-sm .btn {
        padding: 0.25rem 0.5rem;
    }
</style>
@endsection