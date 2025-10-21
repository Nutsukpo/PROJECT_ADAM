@extends('layout.master')

@section('title', 'Leave List')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaves List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #1a73e8;
            --header-bg: #5f9ea0; /* Cadet blue */
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid #e9ecef;
        }
        
        #leavesTable {
            font-size: 0.875rem;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        #leavesTable thead th {
            background-color: var(--header-bg);
            border: none;
            position: sticky;
            top: 0;
            z-index: 1;
        }
        
        #leavesTable tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }
        
        .badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
            font-weight: 500;
        }
        
        .dropdown-item.active .badge {
            background-color: white !important;
            color: var(--bs-primary) !important;
        }
        
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_filter input {
            font-size: 0.875rem;
        }
        
        .table-hover tbody tr:hover td {
            background-color: rgba(13, 110, 253, 0.05);
        }
        
        .btn-outline {
            border-color: rgba(0, 0, 0, 0.1);
        }
        
        .status-badge-approved {
            background-color: #198754;
        }
        
        .status-badge-pending {
            background-color: #ffc107;
            color: #000;
        }
        
        .status-badge-rejected {
            background-color: #dc3545;
        }
        
        .status-badge-draft {
            background-color: #6c757d;
        }
        
        .status-badge-cancelled {
            background-color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Leaves</h5>
                <div class="d-flex gap-2">
                    <!-- Status Filter Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" 
                                id="statusFilterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-filter me-1"></i> Status
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="statusFilterDropdown">
                            <li><a class="dropdown-item filter-status" href="#" data-status="">All Statuses</a></li>
                            <li>
                                <a class="dropdown-item filter-status" href="#" data-status="approved">
                                    <span class="badge status-badge-approved me-2">Approved</span> Approved
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item filter-status" href="#" data-status="pending">
                                    <span class="badge status-badge-pending me-2">Pending</span> Pending
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item filter-status" href="#" data-status="rejected">
                                    <span class="badge status-badge-rejected me-2">Rejected</span> Rejected
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item filter-status" href="#" data-status="draft">
                                    <span class="badge status-badge-draft me-2">Draft</span> Draft
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <a href="{{ route('leaves.create') }}" class="btn btn-sm text-light" style="background-color: cadetblue;">
                        <i class="fas fa-plus me-1"></i> New Leave
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show py-2 mb-3">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($leaves->isEmpty())
                    <div class="alert alert-info py-2">No leaves found.</div>
                @else
                    <div class="table-responsive">
                        <table id="leavesTable" class="table table-hover table-sm" style="width:100%">
                            <thead class="text-light" style="background-color: cadetblue;">
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Employee</th>
                                    <th>Leave Type</th>
                                    <th width="10%">Start Date</th>
                                    <th width="10%">End Date</th>
                                    <th width="12%">Days Applied For</th>
                                    <th width="12%">Days Granted</th>
                                    <th width="9%">Status</th>
                                    <th width="10%">Applied On</th>
                                    <th width="10%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaves as $leave)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $leave->full_name ?? 'N/A' }}</td>
                                        <td>{{ $leave->leave_type }}</td>
                                        <td data-order="{{ $leave->date_commencement }}">
                                            {{ \Carbon\Carbon::parse($leave->date_commencement)->format('d M, Y') }}
                                        </td>
                                        <td data-order="{{ $leave->date_resumption }}">
                                            {{ \Carbon\Carbon::parse($leave->date_resumption)->format('d M, Y') }}
                                        </td>
                                        <td>{{ $leave->days_applied_for}}</td>
                                        <td>{{ $leave->days_granted}}</td>
                                        <td data-order="{{ $leave->status }}">
                                            @php
                                                $statusClass = 'status-badge-' . $leave->status;
                                            @endphp
                                            <span class="badge rounded-pill {{ $statusClass }} text-white">
                                                {{ ucfirst($leave->status) }}
                                            </span>
                                        </td>
                                        <td data-order="{{ $leave->created_at }}">
                                            {{ \Carbon\Carbon::parse($leave->created_at)->format('d M, Y') }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('leaves.watch', $leave->id) }}" 
                                                   class="btn btn-sm btn-outline text-light" style="background-color: cadetblue;"
                                                   title="View">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                @if($leave->status === 'draft' || $leave->status === 'pending')
                                                    <a href="{{ route('leaves.edit', $leave->id) }}" 
                                                       class="btn btn-sm btn-outline text-light bg-warning" 
                                                       title="Edit">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                @endif
                                            </div>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#leavesTable').DataTable({
            "order": [[7, "desc"]], // Default sort by applied date
            "columnDefs": [
                { "orderable": false, "targets": [0, 8] }, // Disable sorting for # and Actions
                { "type": "date", "targets": [3, 4, 7] }, // Date sorting
                { "type": "num", "targets": 5 }  // Numeric sorting for days
            ],
            "responsive": true,
            "pageLength": 25,
            "dom": '<"top"lf>rt<"bottom"ip><"clear">',
            "language": {
                "search": "",
                "searchPlaceholder": "Search leaves...",
                "lengthMenu": "Show _MENU_ leaves",
                "info": "Showing _START_ to _END_ of _TOTAL_ leaves",
                "infoEmpty": "No leaves available",
                "paginate": {
                    "previous": "<i class='fas fa-chevron-left'></i>",
                    "next": "<i class='fas fa-chevron-right'></i>"
                }
            },
            "initComplete": function() {
                $('.dataTables_filter input').addClass('form-control form-control-sm');
                $('.dataTables_length select').addClass('form-select form-select-sm');
            }
        });

        // Status filter functionality
        $('.filter-status').on('click', function(e) {
            e.preventDefault();
            var status = $(this).data('status');
            var badge = $(this).find('.badge').clone();
            
            // Update dropdown button text
            if (status) {
                badge.addClass('me-2');
                $('#statusFilterDropdown').html(
                    `<i class="fas fa-filter me-1"></i>` + 
                    badge[0].outerHTML + 
                    $(this).text().trim()
                );
            } else {
                $('#statusFilterDropdown').html('<i class="fas fa-filter me-1"></i> Status');
            }
            
            // Filter the table
            table.column(6).search(status).draw();
            
            // Highlight selected item
            $('.filter-status').removeClass('active');
            $(this).addClass('active');
        });
    });
    </script>
</body>
</html>



@endsection