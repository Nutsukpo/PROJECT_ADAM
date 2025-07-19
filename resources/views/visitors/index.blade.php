@extends('layout.master')

@section('title','Add Vsitor')

@section('content')
<div class="card shadow mb-1">
    <div class="card-header py-3">
        <div class="d-sm-flex align-items-center justify-content-between ">
            <h6 class="h3 mb-0 text-dark">Visitors List</h6>
            <h6 class="m-0 font-weight-bold text-info"><a class="m-0 font-weight-bold text-info" style="text-decoration:none" href="/visitors/create">Add Vistior</a></h6>   
        </div>
            </div>
                <div class="card-body">
                        <table class="table table-bordered text-4xl" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-light "  style="background: cadetblue;"> 
                                            <th>Action</th>
                                            <th>Client Name</th>
                                            <th>Contact</th>
                                            <th>Department</th>
                                            <th>Gender</th>
                                            <th>Vulnerability</th>
                                            <th>Purpose of Visit</th> 
                                            <th>Arrival</th> 
                                            <th>Departure</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- using foreach loop to iterate through visitors list -->
                                    @foreach($visitors as $visitor)
                                        <tr class="mb-5">
                                            <td>{{$visitor->action}}
                                            <a style="text-decoration:none" href="/visitors/{{$visitor->id}}/watch"><i class="text-info" >view</i></a></td>
                                            <td class="text-bold text-small">{{$visitor->visitor_name}}</td>
                                            <td class="text-bold text-small">{{$visitor->contact}}</td>
                                            <td class="text-bold text-small">{{$visitor->department}}</td>
                                            <td class="text-bold text-small">{{ucfirst($visitor->gender)}}</td>
                                            <td class="text-bold text-small">{{$visitor->vulnerability}}</td>
                                            <td class="text-bold text-small">{{$visitor->purpose_of_visit}}</td>
                                            <td class="text-bold text-small">{{$visitor->time_in}}</td>
                                            <td class="text-bold text-small">{{$visitor->time_out}}</td>
                                            <td class="text-bold text-small">{{$visitor->visiting_date}}</td>
                                            <td>
                                                <!-- code to edit -->
                                                <a href="/visitors/{{$visitor->id}}/edit"
                                                class="btn btn-info btn-square btn-small "><i"></i></a>

                                            <!-- code to delete  -->
                                                <a href="/visitors/{{$visitor->id}}/delete"
                                                class="btn btn-danger btn-square btn-small  " data-toggle="modal" data-target="#deleteModal"</a>                   
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
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Action?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Delete" if you want to remove visitor from the list.</div>
                <div class="modal-footer">
                    <button class="btn btn-info" type="button" data-dismiss="modal">Cancel</button>
                    <form action="/visitors/{{$visitor->id}}/delete" method="POST">
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

<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let visitorId = button.data('id');
        let form = $('#deleteForm');
        form.attr('action', '/visitors/' + visitorId + '/delete');
    });
</script>



@endsection


