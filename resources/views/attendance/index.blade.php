@extends('layout.master')

@section('title','Add Attendance')

@section('content')
<div class="card shadow mb-1">
    <div class="card-header py-3">
        <!-- <h6 class="m-0 font-weight-bold text-info">Student List</h6> -->
        
        <h6 class="m-0 font-weight-bold text-info"><a class="m-0 font-weight-bold text-info" style="text-decoration:none" href="/attendance/create">Add Attendance</a></h6>
            </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-4xl" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-light "  style="background: cadetblue;"> 
                                            <th>Action</th>
                                            <th>Staff Name</th>
                                            <th>Arrival Time</th>
                                            <th>Status</th>
                                            <th>Attendance Date</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- using foreach loop to iterate through student list -->
                                    @foreach($attendance as $attendances)
                                        <tr class="mb-5">
                                            <td>{{$attendances->action}}
                                            <a style="text-decoration:none" href="/attendance/{{$attendances->id}}/watch"
                                                ><i class="text-info" >view</i></a>

                                            </td>
                                            <td class="text-small text-bold">{{$attendances->name_of_employee}}</td>
                                            <td class="text-bold text-small">{{$attendances->time}}</td>
                                            <td class="text-bold text-small">{{ucfirst($attendances->clock_in)}}</td>
                                            <td class="text-bold text-small">{{ucfirst($attendances->attendance_date)}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
            </div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#dataTable').DataTable();
});
</script>



@endsection




