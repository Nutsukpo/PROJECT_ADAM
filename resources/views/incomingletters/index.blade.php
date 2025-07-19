@extends('layout.master')

@section('title', 'Incoming Letters List')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h5 class="text-dark">Incoming Letters List</h5>
        <h6 class="m-0 font-weight-bold text-info">
            <a class="m-0 font-weight-bold text-info" style="text-decoration: dotted;" href="/incomingletters/create">Add Incoming Letter</a>
        </h6>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr class="text-light" style="background: cadetblue;"> 
                    <th>Action</th>
                    <th>Letter ID</th>
                    <th>Reference No</th>
                    <th>Organization Name</th>
                    <th>Description</th>
                    <th>Receiving Date</th>
                    <th>To Whom Received</th>
                    <th>Date Of Letter</th>
                    <th>Sender</th>
                    <th>Mode Of Letter</th>
                    <th>Person Receiving</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($incomingletters as $incomingletter)
                    <tr>
                        <td>
                            <a style="text-decoration:none" href="/incomingletters/{{ $incomingletter->id }}/watch">
                                <i class="text-info">view</i>
                            </a>
                        </td>
                        <td>{{ ucfirst($incomingletter->letter_id) }}</td>
                        <td>{{ ucfirst($incomingletter->reference_no) }}</td>
                        <td>{{ $incomingletter->organization_name }}</td>
                        <td>{{ $incomingletter->description }}</td>
                        <td>{{ $incomingletter->receiving_date }}</td>
                        <td>{{ $incomingletter->to_whom_received }}</td>
                        <td>{{ $incomingletter->date_of_letter }}</td>
                        <td>{{ $incomingletter->sender }}</td>
                        <td>{{ $incomingletter->mode_of_letter }}</td>
                        <td>{{ $incomingletter->name_of_person_receiving }}</td>
                        <td>
                            <a href="/incomingletters/{{ $incomingletter->id }}/edit" class="btn btn-info btn-small"></a>
                            <button class="btn btn-danger btn-small"
                                    data-toggle="modal"
                                    data-target="#deleteModal"
                                    data-id="{{ $incomingletter->id }}"
                                    data-letterid="{{ $incomingletter->letter_id }}">
                                <!-- Delete -->
                            </button>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center text-muted">No incoming letters found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>          
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm Action?</h5>
        <button class="close" type="button" data-dismiss="modal">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        Select "Delete" if you want to remove this from the list.
      </div>
      <div class="modal-footer">
        <button class="btn btn-info" type="button" data-dismiss="modal">Cancel</button>
        <form method="POST" id="deleteForm">
          @csrf
          <button class="btn btn-danger" type="submit">Delete</button>
        </form>
      </div>
    </div>
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
        let incomingletterId = button.data('id');
        let form = $('#deleteForm');
        form.attr('action', '/incomingletters/' + incomingletterId + '/delete');
    });
</script>
@endsection
