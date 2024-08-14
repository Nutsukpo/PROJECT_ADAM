@extends('layout.master')

@section('title','Add employee')

@section('content')
<!-- <h6 class="h3 mb-0 text-dark">Employee List</h6> -->
<div class="card shadow mb-1">
    
    <div class="card-header py-3">
        <div class="d-sm-flex align-items-center justify-content-between ">
            <h6 class="h3 mb-0 text-dark">Employee List</h6>
            <h6 class="m-0 font-weight-bold text-info"><a class="m-0 font-weight-bold text-info" style="text-decoration:none" href="/employees/create">Add Employee</a></h6>
            
        </div>
        
            </div>
                <div class="card-body">
                        <table class="table table-bordered text-4xl" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-light "  style="background: cadetblue;"> 
                                            <th>Action</th>
                                            <th>EMP.ID</th>
                                            <th>F.Name</th>
                                            <th>L.Name</th>
                                            <th>Contact</th>
                                            <th>Email Address</th>
                                            <th>Department</th>
                                            <th>Address</th> 
                                            <th>Position</th> 
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- using foreach loop to iterate through student list -->
                                    @foreach($employees as $employee)
                                        <tr class="mb-5">
                                            <td>{{$employee->action}}
                                            <a style="text-decoration:none" href="/employees/{{$employee->id}}/watch"
                                                ><i class="text-info" >view</i></a>

                                            </td>
                                            <td class="text-small text-bold">{{$employee->employee_id}}</td>
                                            <td class="text-bold text-small">{{ucfirst($employee->firstname)}}</td>
                                            <td class="text-bold text-small">{{ucfirst($employee->lastname)}}</td>
                                            <td class="text-bold text-small">{{$employee->contact}}</td>
                                            <td class="text-bold text-small">{{$employee->email}}</td>
                                            <td class="text-bold text-small">{{ucfirst($employee->department)}}</td>
                                            <td class="text-bold text-small">{{$employee->address}}</td>
                                            <td class="text-bold text-small">{{$employee->position}}</td>
                                            <td>
                                                <!-- code to edit -->
                                                <a href="/employees/{{$employee->id}}/edit"
                                                class="btn btn-info btn-square btn-small "><i"></i></a>

                                            <!-- code to delete  -->
                                                <a href="/employees/{{$employee->id}}/delete"
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
                <div class="modal-body">Select "Delete" if you want to remove employee from the list.</div>
                <div class="modal-footer">
                    <button class="btn btn-info" type="button" data-dismiss="modal">Cancel</button>
                    <form action="/employees/{{$employee->id}}/delete" method="POST">
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


