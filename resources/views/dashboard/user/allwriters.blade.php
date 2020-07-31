@extends('dashboard.master')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">All Writers</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>                               
                                <th>Company Name</th>
                                <th>Status</th>   
                                <th>Action</th>                             
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($writers as $writer)
                                <tr>
                                   <td>{{$writer->name}}</td> <td>{{$writer->email}}</td> <td>{{$writer->phone}}</td> <td>{{$writer->company_name}}</td> <td>@if ($writer->status == 0) Approved @else Unapproved @endif</td><td><a class="btn bt-xs" href="{{ url('/editwriter/')}}/{{$writer->id}}"><i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    {{$writers ->links()}}
                    <!-- /.box-body -->

                    
                </div>
            </div>
        </div>
    </div>
@stop
