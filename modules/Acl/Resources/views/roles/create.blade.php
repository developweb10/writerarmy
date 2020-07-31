@extends('acl::layouts.master')

@section('content')

  <div class="row col-md-12">
    <div class="container">
      <div class="box">
        <div class="well well-sm box-header">
          <h4 class="box-title"> {!! isset($role) ? "Update" : "Add new" !!} Role</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @include('acl::roles.form')
            @include('acl::layouts.sidebar')
        </div>
        <!-- /.box-body -->
      </div>
    </div>
</div>

@stop


@section('scripts')

@stop
