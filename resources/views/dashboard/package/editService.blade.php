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
                    <h3 class="box-title">Edit Service</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body addpackage paddinglr-0">
                    <div class="">
                    <form method="post" action="{{ url('/postAddPackage') }}" enctype="multipart/form-data" class="form">
                      {!! csrf_field() !!}
                      <input type="hidden" name="id" value="{{$package->id}}"/>
                        <div class="col-md-12">
                        
                            <div class="row">    
                                <div class="form-group">
                                <label class="col-md-2 control-label">Title</label>
                                <div class="col-md-10">
                                 <input type="text"  class="form-control"  name="title" value="{{$package->title}}" required="required" />
                                </div>
                                </div>
                                 <div class="form-group">
                                <label class="col-md-2 control-label">Price</label>
                                <div class="col-md-10">
                                 <input type="text"  class="form-control"  name="price" value="{{$package->price}}" required="required" />
                                </div>
                                </div>
                                
                                <div class="form-group">
                                <label class="col-md-2 control-label">Type</label>
                                <div class="col-md-10">
                                <select class="form-control" name="type">
                                 <option value="article"   @if($package->type == 'article') selected ="selected"   @endif>Article</option>
                                 <option value="social"  @if($package->type == 'social') selected ="selected"   @endif>Social</option>
                                 <option value="perAd" @if($package->type == 'perAd') selected ="selected"   @endif>Single Ad</option>
                               <option value="form"   @if($package->type == 'form') selected ="selected"   @endif>Form</option>
                                </select>
                                </div>
                                </div>
                                
                               
                                <label class="col-md-2 control-label">Image</label>
                                
                                <div class="col-md-10">
                                <div class="row attachedcont">
                                @if($package->image_path != '')
                                
                                <div class="col-md-3">
                                 <img src="{{url($package->image_path)}}" class="serviceimage"/></div>
                                 @endif
                                 <div class="col-md-9">
                                  {{ Form::file('attachment', ['class'=>'attachment form-control']) }}</div>
                                </div>
                                </div> </div>
                                <div class="form-group row">
                                <label class="col-md-2 control-label">Description</label>
                                <div class="col-md-10">
                                <textarea name="description" class="form-control" id="area2" >{{$package->content}}</textarea>
                                </div>
                                </div>
                                <div class="form-group row">
                                <label class="col-md-2 control-label">Icon</label>
                                <div class="col-md-10">
                                <textarea name="icon" class="form-control" >{{$package->icon}}</textarea>
                                </div>
                                </div>
                                <div class="form-group row">
                                <label class="col-md-2 control-label">Word count (Enter in format ["100", "200"])</label>
                                <div class="col-md-10">                               
                                <textarea name="word_selection" class="form-control" >{{$package->word_selection}}</textarea>
                                </div>
                                </div>


                                <div class="col-md-12">
                                    {!! Form::submit('Submit', ['class'=>'btn btn-success pull-right blue-main-btn']) !!}
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
.serviceimage{width:100%}
.attachedcont{ margin-bottom:15px;}
.addpackage textarea.form-control{ height: 180px;}
</style>
@stop



