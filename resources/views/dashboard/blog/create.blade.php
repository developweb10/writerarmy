@extends('dashboard.master')

@section('content-header')
    <h1>
      <small>Create New Blog Article</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
@stop

@section('content')

    <div class="row">
      <div class="col-md-12">
        {!! Form::open(array('route' => 'dashboard.blog.store', 'files' => true)) !!}
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Create New Blog Article</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
                <div class="box-body">
                  <div class="form-group">
                    <label>Title of the Article</label>
                    {!! Form::text('title', null, ['class' => "form-control input-lg", 'placeholder' => "Write the article title"]) !!}
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    {!! Form::textarea('content', null, ['id' => "editor1", 'class' => "form-control textarea", 'rows' => "3", 'placeholder' => "Enter ..."]) !!}
                  </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-4">
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title"><small>Article Attributes</small></h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
                <div class="box-body">
                  <div class="form-group">
                    <label>Article Status</label>
                    {!! Form::select('status', array('draft' => 'Draft', 'published' => 'Publish'), null, ['class' => 'form-control']) !!}
                  </div>
                  <div class="checkbox">
                    <label>
                      {!! Form::checkbox('is_sticky', true) !!} Is sticky?
                    </label>
                  </div>
                  <div class="form-group">
                    <label for="">Thumbnail image</label>
                    {!! Form::file('thumbnail_src') !!}

                    <p class="help-block">Upload the thumbnail image to show it on the homepage</p>
                    @if ($errors->has('thumbnail_src'))
                    <span class="help-block">
                        <strong class="alert-danger">{{ $errors->first('thumbnail_src') }}</strong>
                    </span>
                    @endif

                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
            <!-- /.box -->
          </div>
          <!--/.col (right) -->
        {!! Form::close() !!}
      </div>
    </div>
@stop

@section('scripts')

<!-- Bootstrap WYSIHTML5 -->
  {!! HTML::script('https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js') !!}
  <script>
    //bootstrap WYSIHTML5 - text editor
    CKEDITOR.replace('editor1');
  </script>
@stop