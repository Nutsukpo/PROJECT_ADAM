@extends('layout.master')

@section('$title',' Payment list')

@section('content')
<div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                <h5 class="text-bold text-dark">Payment List</h5>
                <h6 class="m-0 font-weight-bold text-info"><a class="m-0 font-weight-bold text-info" style="text-decoration: none;" href="/payments/create">Add Payment</a></h6>
            </div>
                <div class="card-body">
                    <!-- <div class="table-responsive"> -->
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr class="text-light " style="background: cadetblue;">
                                            <th>Action</th>
                                            <th>Voucher ID</th>
                                            <th>Payment Date</th>
                                            <th>Name Of Employee</th>
                                            <th>Month Of Payment</th>
                                            <th>Payment Amount</th>
                                            <th>Purpose Of Payment</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- using foreach loop to iterate through users list -->
                                    @foreach($payments as $payment)
                                        <tr>
                                            <td>{{$payment->action}}<a style="text-decoration:none" href="/payments/{{$payment->id}}/watch"><i class="text-info text-decoration-none">view</i></a></td>
                                            <td>{{ucfirst($payment->voucher_id)}}</td>
                                            <td>{{ucfirst($payment->payment_date)}}</td>
                                            <td>{{$payment->name_of_employee}}</td>
                                            <td>{{$payment->month_of_payment}}</td>
                                            <td>{{$payment->payment_amount}}</td>
                                            <td>{{$payment->purpose_of_payment}}</td>
                                            <td>{{$payment->action}}
                                                <!-- code to edit -->
                                                <a href="/payments/{{$payment->id}}/edit"
                                                class="btn btn-info btn-square btn-small "><i class=""></i></a>

                                            <!-- code to delete  -->
                                                <a href="//{{$payment->id}}/delete"
                                                class="btn btn-danger btn-square btn-small " data-toggle="modal" data-target="#deleteModal{{$payment->id}}"><i class=""></i></a>                   
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="deleteModal{{$payment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Confirm Action?</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Select "Delete" if you want to remove {{$payment->name_of_employee}} from the list .</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-info" type="button" data-dismiss="modal">Cancel</button>
                                                        <form action="/payments/{{$payment->id}}/delete" method="POST">
                                                        @csrf
                                                        <button class="btn btn-danger" type="submit">
                                                            Delete
                                                        </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </tbody>
                                </table>
                            <!-- </div> -->
                       </div>
            </div>
@endsection
<!-- delete Modal -->    
</div>
@section('scripts')
<script>
$(document).ready(function() {
    $('#dataTable').DataTable();
});
</script>
@endsection
