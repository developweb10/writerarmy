@extends('dashboard.master')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">All Jobs</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Message</th>
                                <th>From</th>
                                <th>To</th>                               
                                <th>order</th>
                                <th>Status Type</th>  
                                <th>Action</th>                              
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($message_info as $message)
                                <tr>
                                   <td>{{$message->body}}</td> <td>{{$message->from_user}}</td> <td>{{$message->to_user}}</td> <td>{{$message->order_id}}</td> <td>@if ($message->status == 1) Approved @else Unapproved @endif</td>
                                    <td>
                                    <a class="btn bt-xs" href="{{ url('/editmessage/')}}/{{$message->id}}"><i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    {{ $message_info->links() }}
                    <!-- /.box-body -->

                    
                </div>
            </div>
        </div>
    </div>
@stop
