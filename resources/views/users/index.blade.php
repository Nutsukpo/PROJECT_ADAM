@extends('layout.master')

@section('$title',' user list')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h5 class="text-dark">User List</h5>
        <h6 class="m-0 font-weight-bold text-info"><a class="m-0 font-weight-bold text-info" style="text-decoration: none;" href="/users/create">Add User</a></h>
    </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr class="text-light " style="background: cadetblue;">
                                            <th>Action</th>
                                            <th>FullName</th>
                                            <th>Title</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- using foreach loop to iterate through users list -->
                                    @forelse($users as $user)
                                        <tr>
                                            <td>{{$user->action}}<a style="text-decoration:none;" href="/users/{{$user->id}}/watch"><i class="text-info">view</i></a></td>
                                            <td>{{ucfirst($user->name)}}</td>
                                            <td>{{ucfirst($user->title)}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->contact}}</td>
                                            <td>{{$user->action}}
                                                <!-- code to edit -->
                                                <a href="/users/{{$user->id}}/edit" class="btn btn-info btn-square btn-small "><i class=""></i></a>
                                                <button class="btn btn-danger btn-small"
                                                    data-toggle="modal"
                                                    data-target="#deleteModal"
                                                    data-id="{{ $user->id }}">
                                                    <!-- Delete -->
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <!-- <td colspan="9" class="text-center text-muted">No employees found.</td> -->
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                       </div>
                </div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="deleteForm" method="POST">
            @csrf
            <!-- @method('DELETE') -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Action?</h5>
                    <button class="close" type="button" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info" type="button" data-dismiss="modal">cancel</button>
                    <button class="btn btn-danger" type="submit">delete</button>
                </div>
            </div>
        </form>
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
        let userId = button.data('id');
        let form = $('#deleteForm');
        form.attr('action', '/users/' + userId + '/delete');
    });
    
</script>
@endsection