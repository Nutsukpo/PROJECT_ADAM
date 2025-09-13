@extends('layout.master')

@section('title', 'Outgoing Letters List')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Outgoing Letters Management</h1>
        <a href="{{ route('outgoingletters.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add New Letter
        </a>
    </div>

    <div class="card shadow mb-4">
        <!-- <div class="card-header py-3 bg-info">
            <h6 class="m-0 font-weight-bold text-white">All Outgoing Letters</h6>
        </div> -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class=" text-light" style="background-color: cadetblue;">
                        <tr>
                            <th>Letter ID</th>
                            <th>Reference No</th>
                            <th>Organization</th>
                            <th>Description</th>
                            <th>Sending Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($outgoingletters as $letter)
                        <tr>
                            <td>{{ $letter->letter_id }}</td>
                            <td>{{ $letter->reference_no }}</td>
                            <td>{{ $letter->organization_name }}</td>
                            <td>{{ Str::limit($letter->description, 50) }}</td>
                            <td>{{ date('d M Y', strtotime($letter->sending_date)) }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="/outgoingletters/{{$letter->id}}/watch" class="btn btn-sm btn-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="/outgoingletters/{{ $letter->id }}/edit" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger delete-letter" 
                                            data-toggle="modal" 
                                            data-target="#deleteModal"
                                            data-id="{{ $letter->id }}"
                                            data-letterid="{{ $letter->letter_id }}"
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
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete letter <strong id="letterIdDisplay"></strong>?</p>
                <p class="text-danger">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
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
        $('#dataTable').DataTable({
            "order": [[4, "desc"]],
            "columnDefs": [
                { "orderable": false, "targets": [5] }
            ]
        });

        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var letterId = button.data('id');
            var displayId = button.data('letterid');
            var url = '/outgoingletters/' + letterId + '/delete';
            
            $('#letterIdDisplay').text(displayId);
            $('#deleteForm').attr('action', url);
        });
    });
</script>
@endsection