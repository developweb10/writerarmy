@extends('dashboard.master')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Revision Jobs</h3>
                        <br>
                    </div>

                    <!-- /.box-header -->
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
                                            <a class="btn bt-xs btn-success" href="{!! route('assignedJobs.edit', ['id' => $details->id ]) !!}"><i class="fa fa-eye" aria-hidden="true"></i>
                                                Details
                                            </a>
                                        @else
                                            <a class="btn bt-xs btn-danger" data-toggle="modal" data-target="#myModal2"><i class="fa fa-eye" aria-hidden="true"></i>
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
            </div>
        </div>
    </div>
@stop
