@extends('layout.master')

@section('title','view assets')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h6 class="h3 mb-0 text-dark cd">Asset List</h6>
        <h6 class="m-0 font-weight-bold text-info">
            <a class="m-0 font-weight-bold text-info" style="text-decoration: none;" href="/assets/create">Add Asset</a>
        </h6>
    </div>

    <div class="card-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="5">
            <thead>
                <tr class="mb-3" style="background: cadetblue;"> 
                    <th class="text-light">Action</th>
                    <th class="text-light">Asset ID</th>
                    <th class="text-light">Asset Name</th>
                    <th class="text-light">Department For</th>
                    <th class="text-light">Assets Type</th>
                    <th class="text-light">Serial Number</th>
                    <th class="text-light">Asset Cost</th>
                    <th class="text-light">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($assets as $asset)
                    <tr>
                        <td>
                            <a style="text-decoration:none" href="/assets/{{$asset->id}}/watch">
                                <i class="text-info">view</i>
                            </a>
                        </td>
                        <td>{{$asset->asset_id}}</td>
                        <td>{{ucfirst($asset->asset_name)}}</td>
                        <td>{{ucfirst($asset->department_for)}}</td>
                        <td>{{$asset->asset_type}}</td>
                        <td>{{$asset->serial_number}}</td>
                        <td>{{$asset->asset_cost}}</td>
                        <td>
                            <a href="/assets/{{$asset->id}}/edit" class="btn btn-info btn-small">
                                <!-- Edit -->
                            </a>

                            <button class="btn btn-danger btn-small" data-toggle="modal" data-target="#deleteModal" data-id="{{$asset->id}}">
                                <!-- Delete -->
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <!-- <td colspan="8" class="text-center">No assets found.</td> -->
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

    // Dynamically set form action based on asset ID
    $('#deleteModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let assetId = button.data('id');
        let form = $('#deleteForm');
        form.attr('action', '/assets/' + assetId + '/delete');
    });
</script>
@endsection
