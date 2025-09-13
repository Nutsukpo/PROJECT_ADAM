@extends('layout.master')

@section('title', 'Memo List')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Memos</h5>
        <div class="d-flex gap-2">
            <!-- Status Filter Dropdown -->
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" 
                        id="statusFilterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-filter me-1"></i> Status
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="statusFilterDropdown">
                    <li><a class="dropdown-item filter-status" href="#" data-status="">All Statuses</a></li>
                    @foreach(array_unique(App\Models\Memos::STAGES) as $status)
                        @php
                            $statusColors = App\Models\Memos::stageColors();
                            $color = $statusColors[$status] ?? 'secondary';
                        @endphp
                        <li>
                            <a class="dropdown-item filter-status" href="#" data-status="{{ $status }}">
                                <span class="badge bg-{{ $color }} me-2">{{ ucfirst($status) }}</span>
                                {{ ucfirst($status) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            
            <a href="{{ route('memos.create') }}" class="btn btn-sm text-light btn btn-info" ">
                <i class="fas fa-plus me-1"></i> New Memo
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

        @if ($memos->isEmpty())
            <div class="alert alert-info py-2">No memos found.</div>
        @else
            <div class="table-responsive">
                <table id="memosTable" class="table table-hover table-sm" style="width:100%">
                    <thead class="text-light" style="background-color: cadetblue;">
                        <tr>
                            <th width="5%">#</th>
                            <th>To</th>
                            <th>From</th>
                            <th width="10%">Date</th>
                            <th>Subject</th>
                            <th width="12%">Current Status</th>
                            <th width="12%">Amount</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($memos as $memo)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ Str::limit($memo->to, 20) }}</td>
                                <td>{{ Str::limit($memo->from, 20) }}</td>
                                <td data-order="{{ $memo->date }}">
                                    {{ \Carbon\Carbon::parse($memo->date)->format('d M, Y') }}
                                </td>
                                <td>{{ Str::limit($memo->subject, 30) }}</td>
                                <td data-order="{{ $memo->status }}">
                                    @php
                                        $statusColors = App\Models\Memos::stageColors();
                                        $color = $statusColors[$memo->status] ?? 'secondary';
                                    @endphp
                                    <span class="badge rounded-pill bg-{{ $color }} text-white">
                                        {{ ucfirst($memo->status) }}
                                    </span>
                                </td>
                                <td data-order="{{ $memo->amount }}">
                                    {{ number_format($memo->amount, 2) }} {{ $memo->currency }}
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('memos.watch', $memo->id) }}" 
                                           class="btn btn-sm btn-outline text-light" style="background-color: cadetblue;"
                                           title="View">
                                            <i class="far fa-eye"></i>
                                        </a>
                                        @if($memo->status === 'draft')
                                            <a href="{{ route('memos.edit', $memo->id) }}" 
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
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    #memosTable {
        font-size: 0.875rem;
        border-collapse: separate;
        border-spacing: 0;
    }
    #memosTable thead th {
        border-bottom: 2px solid #e9ecef;
        position: sticky;
        top: 0;
        z-index: 1;
    }
    #memosTable tbody tr:hover {
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
</style>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#memosTable').DataTable({
        "order": [[3, "desc"]], // Default sort by date (4th column)
        "columnDefs": [
            { "orderable": false, "targets": [0, 7] }, // Disable sorting for # and Actions
            { "type": "date", "targets": 3 }, // Date sorting
            { "type": "num", "targets": 6 }  // Numeric sorting for amount
        ],
        "responsive": true,
        "pageLength": 25,
        "dom": '<"top"lf>rt<"bottom"ip><"clear">',
        "language": {
            "search": "",
            "searchPlaceholder": "Search memos...",
            "lengthMenu": "Show _MENU_ memos",
            "info": "Showing _START_ to _END_ of _TOTAL_ memos",
            "infoEmpty": "No memos available",
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
        table.column(5).search(status).draw();
        
        // Highlight selected item
        $('.filter-status').removeClass('active');
        $(this).addClass('active');
    });
});
</script>
@endsection