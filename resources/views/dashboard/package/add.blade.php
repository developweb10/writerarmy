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
                <div class="box-header">
                    <h3 class="box-title"> Add Service</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body addpackage">
                    <div class="col-md-12">
                    <form method="post" action="{{ url('/postAddPackage') }}" enctype="multipart/form-data" class="form col-md-12">
                      {!! csrf_field() !!}
                        <div class="col-md-12">
                            <div class="row">    
                                <div class="form-group">
                                <label class="col-md-2 control-label">Title</label>
                                <div class="col-md-10">
                                 <input type="text"  class="form-control"  name="title" value="" required="required" />
                                </div>
                                </div>
                                 <div class="form-group">
                                <label class="col-md-2 control-label">Price</label>
                                <div class="col-md-10">
                                 <input type="text"  class="form-control"  name="price" value="" required="required" />
                                </div>
                                </div>
                                
                                <div class="form-group">
                                <label class="col-md-2 control-label">Type</label>
                                <div class="col-md-10">
                                <select class="form-control" name="type">
                                 <option value="article">Article</option>
                                 <option value="social">Social</option>
                                 <option value="perAd">Single Ad</option>
                                 <option value="form">Form</option>
                                </select>
                                </div>
                                </div>
                                
                                <div class="form-group">
                                <label class="col-md-2 control-label">Image</label>
                                <div class="col-md-10">
                                  {{ Form::file('attachment', ['class'=>'attachment form-control']) }}
                                <!-- <input type="file" name="attachment" class="form-control" />-->
                                </div>
                                </div>
                                <div class="form-group">
                                <label class="col-md-2 control-label">Description</label>
                                <div class="col-md-10">
                                <textarea name="description" class="form-control" id="area2" ></textarea>
                                </div>
                                </div>
                                 <div class="form-group">
                                <label class="col-md-2 control-label">Icon</label>
                                <div class="col-md-10">
                                <textarea name="icon" class="form-control"></textarea>
                                </div>
                                </div>
                                   <div class="form-group row">
                                <label class="col-md-2 control-label">Word count (Enter in format ["100", "200"])</label>
                                <div class="col-md-10">                               
                                <textarea name="word_selection" class="form-control" ></textarea>
                                </div>
                                </div>



                                <div class="col-md-12">
                                    {!! Form::submit('Submit', ['class'=>'btn btn-success pull-right']) !!}
                                </div>
                            </div>
                        </div>
                           {!! Form::close() !!}
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
<style>
.addpackage .form-group {
    margin-bottom: 15px;
    display: inline-block;
    width: 100%;
}
.addpackage textarea.form-control{ height: 180px;}
</style>
@stop



