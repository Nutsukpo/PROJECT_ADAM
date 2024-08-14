@extends('layout.master')

@section('title','view assets')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h6 class="text-dark">Asset List</h6>
        <h6 class="m-0 font-weight-bold text-info"><a class="m-0 font-weight-bold text-info" style="text-decoration: none;" href="/assets/create">Add Asset</a></h6>
    </div>
                <div class="card-body">
            
                    <!-- <div class="table-responsive"> -->
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="mb-3 "  style="background: cadetblue;"> 
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
                                        <!-- using foreach loop to iterate through student list -->
                                    @foreach($assets as $asset)
                                        <tr>
                                            <td>{{$asset->action}}
                                            <a style="text-decoration:none" href="/assets/{{$asset->id}}/watch"
                                                ><i class="text-info">view</i></a>

                                            </td>
                                            <td>{{$asset->asset_id}}</td>
                                            <td>{{ucfirst($asset->asset_name)}}</td>
                                            <td>{{ucfirst($asset->department_for)}}</td>
                                            <td>{{$asset->asset_type}}</td>
                                            <td>{{$asset->serial_number}}</td>
                                            <td>{{$asset->asset_cost}}</td>
                                            <td>
                                                <!-- code to edit -->
                                                <a href="/assets/{{$asset->id}}/edit"
                                                class="btn btn-info btn-square btn-small "><i class=""></i></a>

                                            <!-- code to delete  -->
                                                <a href="/assets/{{$asset->id}}/delete"
                                                class="btn btn-danger btn-square btn-small glyphicon glyphicon-remove" data-toggle="modal" data-target="#deleteModal"><i class="glyphicon glyphicon-remove"></i></a>                   
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                        </table>
                            <!-- </div> -->
                    </div>
            </div>
@endsection
<!-- delete Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
                <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Action?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Delete" if you want to remove asset from the list.</div>
                <div class="modal-footer">
                    <button class="btn btn-info" type="button" data-dismiss="modal">Cancel</button>
                    <form action="/assets/{{$asset->id}}/delete" method="POST">
                    @csrf
                    <button class="btn btn-danger" type="submit">
                        Delete
                    </button>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
$(document).ready(function() {
    $('#dataTable').DataTable();
});
</script>



@endsection

