@extends('dashboard.master')

@section('content-header')
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    </ol>
@stop


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header serviceheder">
                    <h3 class="box-title">All Services</h3>
                    <a class="addservice" href="{{ url('/addService') }}">Add New Service </a>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                            <th>Image</th>
                                <th>Title</th>
                                <th>Price</th>                               
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                    @foreach($packages as $package)
                           <tr>
                              <td> @if($package->image_path != '')
                                 <img src="{{url($package->image_path)}}" class="serviceimage"/>
                                 @endif</td>
                                <td> <a href="{{ $package->id }}">    <strong> {{ $package->title }}</strong>  </a></td>
                                <td>{{ $package->price }}</td>                               
                                <td><a class="btn bt-xs btn-success" href="{{ url('/service/edit', $package->id ) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp; &nbsp; <a class="btn bt-xs btn-danger" href="{{ url('/packagedelete', $package->id ) }}"> <i class="glyphicon glyphicon-trash"></i> </a></td>
                            </tr>
                
                    @endforeach
                    </tbody>
                    </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <style>
	.serviceheder .addservice{
	 float: right;
	 padding: 6px 10px;
	 color: #fff;
	 background:#3c8dbc;
	 border-radius:5px;
	}
	.content{ padding-top:30px;}
	.serviceimage{ width:70px; height:70px;}
	</style>
@stop



