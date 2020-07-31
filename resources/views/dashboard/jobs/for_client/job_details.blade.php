@extends('dashboard.master')

@section('content')

    <div class="row">
        <div class="col-md-12 order-table-box">

            {{--<div class="col-md-12">--}}
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title" style="color: lightseagreen">Assigned Orders</h3>
                        <br>
                    </div>

                    {{--@include('dashboard.jobs.for_client.assigned_order_search')--}}

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>SL No.</th>
                                <th>Order Name</th>
                                <th>Client Name</th>
                                <th>Writer Name</th>
                                {{--<th>Description</th>--}}
                                <th>Submission Date</th>
                                <th>Status Type</th>
                                <th>Details</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($job_details as $i => $details)
                                <tr>
                                    <td> {!! $i + 1 !!}</td>
                                    <td>{!! $details->order->packages->title or '---' !!}</td>
                                    <td>{!! $details->client->name or '---' !!}</td>
                                    <td>{!! $details->writer->name or '---' !!}</td>
                                    {{--<td>{!! $details->description or '---' !!}</td>--}}
                                    <td>{!! $details->submission_date or '---' !!}</td>
                                    <td><p style="color: #008000">{!! ucfirst(str_replace('_', ' ',strtolower($details->status_type))) !!}</p></td>
                                    <td>
                                        @if($details->writer && $details->client)
                                            <a class="btn bt-xs btn-success" href="{!! route('assignedJobs.edit', ['id' => $details->id ]) !!}"><i class="fa fa-eye" aria-hidden="true"></i>
                                                Details
                                            </a>
                                        @else
                                            {{--<a class="btn bt-xs btn-danger" data-toggle="modal" data-target="#myModal2"><i class="fa fa-eye" aria-hidden="true"></i>--}}
                                                {{--Details--}}
                                            {{--</a>--}}

                                            <a class="btn bt-xs btn-danger" href="{!! route('assignedJobs.edit', ['id' => $details->id ]) !!}"><i class="fa fa-eye" aria-hidden="true"></i>
                                                Details
                                            </a>
                                        @endif
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
                {{--<br>--}}
            {{--</div>--}}


{{--For Unassigned orders--}}
            {{--<div class="col-md-12">--}}
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title" style="color: darkred">Unassigned Orders</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>SL No.</th>
                                <th>Title</th>
                                <th>Client Name</th>
                                <th>Total Words</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Order Details</th>
                                <th>Submission Date</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($jobs as $i => $job)
                                <tr>
                                    <td> {!! $i + 1 !!}</td>
                                    <td>{!! $job->packages->title or '---' !!}</td>
                                    <td>{!! $job->user->name or '---' !!}</td>
                                    <td>{!! $job->total_words or 'N/A' !!}</td>
                                    <td>{!! $job->quantity or '---' !!}</td>
                                    <td>${{ number_format((float)$job->price, 2, '.', '') }}</td>
                                    <td>{!! $job->order_details or '---' !!}</td>
                                    <td>{!! date("d/m/Y", strtotime($job->created_at)) !!}</td>
                                    <td bgcolor="#d3d3d3"> Unassigned </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            {{--</div>--}}

        </div>
    </div>
@stop
