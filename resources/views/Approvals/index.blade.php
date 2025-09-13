@extends('layout.master')

@section('title', 'Memo Approvals')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <!-- Header -->
        <div class="card-header bg-white py-3 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <h5 class="mb-2 mb-md-0 text-dark">Memo Approval Dashboard</h5>
            <div class="d-flex flex-wrap gap-2">

                <!-- Status Filter Dropdown -->
                <div class="dropdown mb-2 mb-md-0">
                    <button class="btn btn-sm dropdown-toggle d-flex align-items-center bg-success text-light"
                            type="button" id="statusFilterDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-filter me-1"></i>
                        @if(isset($status))
                            <span class="badge bg-{{ \App\Models\Memos::stageColors()[$status] ?? 'secondary' }} me-2 text-white">
                                {{ ucfirst($status) }}
                            </span>
                        @else
                            <span>All Statuses</span>
                        @endif
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="statusFilterDropdown">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('approvals.index') }}">
                                <span class="badge bg-success me-2 opacity-50" style="width: 20px;">&nbsp;</span>
                                All Statuses
                            </a>
                        </li>
                        @foreach($statuses as $stage)
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('approvals.filter', $stage) }}">
                                    <span class="badge bg-{{ \App\Models\Memos::stageColors()[$stage] ?? 'secondary' }} me-2 text-white" style="width: 20px;">&nbsp;</span>
                                    {{ ucfirst($stage) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Export Dropdown -->
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-light bg-danger text-white dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-download me-1"></i> Export
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        <li><a class="dropdown-item export-action" href="#" data-type="excel">
                            <i class="fas fa-file-excel text-success me-2"></i> Excel</a></li>
                        <li><a class="dropdown-item export-action" href="#" data-type="pdf">
                            <i class="fas fa-file-pdf text-danger me-2"></i> PDF</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item export-action" href="#" data-type="print">
                            <i class="fas fa-print text-info me-2"></i> Print</a></li>
                    </ul>
                </div>

            </div>
        </div>

        <!-- Body -->
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show py-2 mb-3">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($memos->isEmpty())
                <div class="alert alert-info py-3">
                    <i class="fas fa-info-circle me-2"></i> No memos found matching your criteria.
                </div>
            @else
                <div class="table-responsive">
                    <table id="approvalsTable" class="table table-hover table-sm w-100">
                        <thead class="text-white" style="background-color: #5f9ea0;">
                            <tr>
                                <th width="5%">Ref #</th>
                                <th>Recipient</th>
                                <th>Sender</th>
                                <th width="12%">Date</th>
                                <th>Subject</th>
                                <th width="12%">Current Status</th>
                                <th width="12%">Last Updated</th>
                                <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($memos as $memo)
                                @php
                                    $statusColors = \App\Models\Memos::stageColors();
                                    $statusIcons = method_exists(\App\Models\Memos::class, 'stageIcons') 
                                        ? \App\Models\Memos::stageIcons() 
                                        : [
                                            'pending' => 'clock',
                                            'approved' => 'check-circle',
                                            'rejected' => 'times-circle',
                                            'reviewed' => 'eye',
                                            'draft' => 'file-alt'
                                        ];
                                @endphp
                                <tr class="align-middle">
                                    <td class="fw-semibold">{{ $memo->id }}</td>
                                    <td>
                                        <span class="d-inline-block text-truncate"
                                              style="max-width: 150px;"
                                              title="{{ $memo->to }}"
                                              data-bs-toggle="tooltip">
                                            {{ $memo->to }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="d-inline-block text-truncate"
                                              style="max-width: 150px;"
                                              title="{{ $memo->from }}"
                                              data-bs-toggle="tooltip">
                                            {{ $memo->from }}
                                        </span>
                                    </td>
                                    <td data-order="{{ $memo->date }}" class="text-nowrap">
                                        {{ \Carbon\Carbon::parse($memo->date)->format('d M, Y') }}
                                    </td>
                                    <td>
                                        <span class="d-inline-block text-truncate"
                                              style="max-width: 200px;"
                                              title="{{ $memo->subject }}"
                                              data-bs-toggle="tooltip">
                                            {{ $memo->subject }}
                                        </span>
                                    </td>
                                    <td data-order="{{ $memo->status }}">
                                        <span class="badge rounded-pill bg-{{ $statusColors[$memo->status] ?? 'secondary' }} text-white">
                                            <i class="fas fa-{{ $statusIcons[$memo->status] ?? 'circle' }} me-1"></i>
                                            {{ ucfirst($memo->status) }}
                                        </span>
                                    </td>
                                    <td data-order="{{ $memo->updated_at }}"
                                        title="{{ $memo->updated_at->format('M d, Y h:i A') }}"
                                        data-bs-toggle="tooltip">
                                        {{ $memo->updated_at->diffForHumans() }}
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="{{ route('approvals.show', $memo->id) }}"
                                           class="btn btn-sm btn-info text-white"
                                           title="Review Memo">
                                            <i class="far fa-eye me-1"></i> Review
                                        </a>
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
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    #approvalsTable {
        font-size: 0.875rem;
    }
    #approvalsTable thead th {
        position: sticky;
        top: 0;
        z-index: 1;
    }
    #approvalsTable tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
    .badge {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
        font-weight: 500;
    }
    .table-hover tbody tr:hover td {
        background-color: rgba(13, 110, 253, 0.05);
    }
    .btn-outline {
        border-color: rgba(0, 0, 0, 0.1);
    }
</style>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#approvalsTable').DataTable({
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>" +
             "<'row'<'col-sm-12'B>>",
        buttons: [
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel"></i> Excel',
                className: 'btn btn-sm btn-success',
                exportOptions: { columns: ':visible' }
            },
            {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf"></i> PDF',
                className: 'btn btn-sm btn-danger',
                exportOptions: { columns: ':visible' }
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i> Print',
                className: 'btn btn-sm btn-info',
                exportOptions: { columns: ':visible' }
            }
        ],
        order: [[3, 'desc']], // Default sort by Date
        responsive: true,
        pageLength: 25,
        language: {
            search: "",
            searchPlaceholder: "Search memos...",
            lengthMenu: "Show _MENU_ memos",
            info: "Showing _START_ to _END_ of _TOTAL_ memos",
            infoEmpty: "No memos available",
            paginate: {
                previous: "<i class='fas fa-chevron-left'></i>",
                next: "<i class='fas fa-chevron-right'></i>"
            }
        },
        initComplete: function() {
            $('.dataTables_filter input').addClass('form-control form-control-sm');
            $('.dataTables_length select').addClass('form-select form-select-sm');
        }
    });

    // Handle export triggers
    $('.export-action').on('click', function(e) {
        e.preventDefault();
        var type = $(this).data('type');
        if (type === 'excel') table.button('.buttons-excel').trigger();
        if (type === 'pdf') table.button('.buttons-pdf').trigger();
        if (type === 'print') table.button('.buttons-print').trigger();
    });

    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();
});
</script>
@endsection
