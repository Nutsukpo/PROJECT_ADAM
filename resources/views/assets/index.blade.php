@extends('layout.master')

@section('title', 'Asset Management')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-dark">Asset Inventory</h5>
            <div>
                <a href="{{ route('assets.create') }}" class="btn btn-info btn-sm">
                    <i class="fas fa-plus-circle mr-1"></i> Add New Asset
                </a>
            </div>
        </div>

        <div class="card-body">
            @if($assets->isEmpty())
                <div class="alert alert-info">
                    <i class="fas fa-info-circle mr-2"></i> No assets found in the system.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="assetsTable" width="100%" cellspacing="0">
                        <thead class="text-white" style="background-color: #5f9ea0;">
                            <tr>
                                <th>ID</th>
                                <th>Asset Name</th>
                                <th>Department</th>
                                <th>Type</th>
                                <th>Serial #</th>
                                <th>Cost</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assets as $asset)
                                <tr>
                                    <td>{{ $asset->asset_id ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('assets.watch', $asset->id) }}" class="text-primary">
                                            {{ ucfirst($asset->asset_name) }}
                                        </a>
                                    </td>
                                    <td>{{ ucfirst($asset->department_for) }}</td>
                                    <td>{{ $asset->asset_type }}</td>
                                    <td>{{ $asset->serial_number }}</td>
                                    <td>{{ number_format($asset->asset_cost, 2) }}</td>
                                    <td>
                                        <span class="badge badge-pill 
                                            @if($asset->status === 'active') badge-success
                                            @elseif($asset->status === 'maintenance') badge-warning
                                            @elseif($asset->status === 'retired') badge-secondary
                                            @else badge-info @endif">
                                            {{ ucfirst($asset->status ?? 'unknown') }}
                                        </span>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="{{ route('assets.watch', $asset->id) }}" 
                                           class="btn btn-sm btn-circle btn-info mr-1"
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('assets.edit', $asset->id) }}" 
                                           class="btn btn-sm btn-circle btn-warning mr-1"
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-circle btn-danger delete-btn"
                                                data-id="{{ $asset->id }}"
                                                data-toggle="modal"
                                                data-target="#deleteModal"
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to permanently delete this asset?</p>
                <p class="text-danger"><small>This action cannot be undone.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Asset</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
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
    #assetsTable tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
    }
    .table thead th {
        vertical-align: middle;
    }
    .table td {
        vertical-align: middle;
    }
    .badge {
        font-size: 0.75rem;
        padding: 0.4em 0.65em;
    }
</style>
@endsection

@section('scripts')
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    $('#assetsTable').DataTable({
        responsive: true,
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search assets...",
            lengthMenu: "Show _MENU_ assets",
            info: "Showing _START_ to _END_ of _TOTAL_ assets",
            infoEmpty: "No assets available",
        },
        columnDefs: [
            { orderable: false, targets: [7] }
        ]
    });

    // Handle delete button click to set proper form action
    $('.delete-btn').click(function() {
        var assetId = $(this).data('id');
        $('#deleteForm').attr('action', '{{ url("assets") }}/' + assetId);
    });
});
</script>
@endsection
