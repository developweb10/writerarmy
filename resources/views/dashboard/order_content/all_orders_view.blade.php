@extends('dashboard.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title" style="color: green">Orders That Are Already Assigned</h3>
                    <br>
                </div>

                <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Order Name</th>
                            <th>Client Name</th>
                            <th>Writer Name</th>
                            {{--<th>Description</th>--}}
                            <th>Submission Date</th>
                            <th>Status Type</th>
                            <th>Details</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($job_details as $details)
                            <tr>
                                <td>{!! $details->order->packages->title or '---' !!}</td>
                                <td>{!! $details->client->name or '---' !!}</td>
                                <td>{!! $details->writer->name or '---' !!}</td>
                                {{--<td>{!! $details->description or '---' !!}</td>--}}
                                <td>{!! $details->submission_date or '---' !!}</td>
                                <td><p style="color: #008000">{!! ucfirst(str_replace('_', ' ',strtolower($details->status_type))) !!}</p></td>
                                <td>
                                    @if($details->writer && $details->client)
                                        <a class="btn btn-xs btn-success" href="{!! route('assignedJobs.edit', ['id' => $details->id ]) !!}"><i class="fa fa-eye" aria-hidden="true"></i>
                                            Details
                                        </a>
                                    @else
                                        {{--<a class="btn bt-xs btn-danger" data-toggle="modal" data-target="#myModal2"><i class="fa fa-eye" aria-hidden="true"></i>--}}
                                            {{--Details--}}
                                        {{--</a>--}}

                                        <a class="btn btn-xs btn-danger" href="{!! route('assignedJobs.edit', ['id' => $details->id ]) !!}"><i class="fa fa-eye" aria-hidden="true"></i>
                                            Details
                                        </a>
                                    @endif
                                     @can('admin.access')
                                       @if($details->status_type == 'order_accepted')
                                       <a class="btn btn-xs btn-info" href="{{ url('/payToWriter/')}}/{{$details->id}}">Pay</a>
                                      @endif 
                                     @endcan
                                </td>

                                <td>
                                    <a class="btn-xs btn-danger orderStatus-destroy" href="{{ URL::route("assignedJobs.destroy", $details->id) }}">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->

                <div class="modal fade" id="myModal2" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <p class="text-center" style="color: maroon">User Deleted/ Not Available</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title" style="color: indianred">Orders That Are Not Assigned Yet</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Order Details</th>
                            <th>Order Placed By</th>
                            <th>Time & Date</th>
                            <th>Action</th>

                            @can('admin.access')
                                @can('client.access')
                                    @can('writer.access')
                                        <th><center> Delete </center></th>
                                    @endcan
                                @endcan
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{!! $order->packages->title or '---' !!}</td>
                                <td>{!! $order->order_details or '---' !!}</td>
                                <td>{!! $order->user->name or '---' !!}</td>
                                <td>{!! $order->created_at or '---' !!}</td>
                                <td>
                                    @if($order->order_placed_by == \Illuminate\Support\Facades\Auth::id())
                                        No access
                                    @else
                                        Job Available
                                    @endif
                                </td>
                                @can('admin.access')
                                @can('client.access')
                                @can('writer.access')
                                    <td>
                                        <center>
                                        <a class="btn-xs btn-danger order-destroy" href="{{ URL::route("order.destroy", $order->id) }}">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </a>
                                        </center>
                                    </td>
                                @endcan
                                @endcan
                                @endcan
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@stop


@section('scripts')

<link rel="stylesheet" type="text/css" href="{{ asset('sweetalert-master/dist/sweetalert.css') }}">
<script src="{{ asset('sweetalert-master/dist/sweetalert.min.js') }}"></script>

<script>
    $('.order-destroy').on("click",function(ev){
        ev.preventDefault();
        var tr = $(this).parents('tr');
        var URL = $(this).attr('href');
//        console.log(URL);

        swal({
                    title: "Are you sure?",
                    text: "By clicking to confirm, You will delete the late consideration.",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, Delete it!",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                },
                function(isConfirm){
                    if(isConfirm) {
                        $.ajax({
                            type: "DELETE",
                            url: URL,
                            success: function(){
                                swal("DELETED!", "Deleted successfully.", "success");
                                tr.remove();
                            }
                        })
                    } else {
                        swal("Cancelled", "Action Cancelled.", "error");
                    }
                });
    });

</script>


<script>
    $('.orderStatus-destroy').on("click",function(ev){
        ev.preventDefault();
        var tr = $(this).parents('tr');
        var URL = $(this).attr('href');
//        console.log(URL);

        swal({
                    title: "Are you sure?",
                    text: "By clicking to confirm, You will delete the late consideration.",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, Delete it!",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                },
                function(isConfirm){
                    if(isConfirm) {
                        $.ajax({
                            type: "DELETE",
                            url: URL,
                            success: function(){
                                swal("DELETED!", "Deleted successfully.", "success");
                                tr.remove();
                            }
                        })
                    } else {
                        swal("Cancelled", "Action Cancelled.", "error");
                    }
                });
    });

</script>

@endsection
