@extends('dashboard.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Available Jobs</h3>
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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jobs as $job)
                            <tr>
                                <td>{!! $job->packages->title or '---' !!}</td>
                                <td>{!! $job->order_details or '---' !!}</td>
                                <td>{!! $job->user->name or '---' !!}</td>
                                <td>{!! $job->created_at or '---' !!}</td>
                                <td>
                                    @if($job->order_placed_by == \Illuminate\Support\Facades\Auth::id())
                                        No access
                                    @else
                                        <a class="btn bt-xs btn-success" href="{!! route('jobs.edit', ['id' => $job->id ]) !!}"><i class="fa fa-eye" aria-hidden="true"></i>
                                            View Job Details
                                        </a>
                                    @endif
                                </td>
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
