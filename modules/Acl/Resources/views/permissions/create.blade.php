@extends('acl::layouts.master')

@section('content')

  <div class="row col-md-12">
    <div class="container">
      <div class="box">
        <div class="box-header">
          <h3 class="well well-md box-title"> {!! isset($permission) ? "Update" : "Add new" !!} Permission</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @include('acl::permissions.form')
            @include('acl::layouts.sidebar')
        </div>
        <!-- /.box-body -->
      </div>
    </div>
</div>

@stop
