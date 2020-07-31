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
                    <h3 class="box-title">Email Templates</h3>                   
                </div>
                
                <!-- /.box-header -->
                <div class="box-body">
                     <table id="example2" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($templates as $template)
                            <tr>
                                <td>{!! $template->name or '---' !!}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ url('/template/edit', $template->id ) }}">Edit</a>
                                </td>
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



