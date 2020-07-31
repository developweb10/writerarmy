@extends('acl::layouts.master')

@section('content')

    <div class="row col-md-12">
      <div class="container">
        <a class="btn btn-success" href="{!! route('acl.permissions.create') !!}"><i class="fa fa-user-plus"></i> Add new Permission</a>
      </div>
      <div class="container">
        <div class="box col-md-9">
          <div class="box-header">
            <h3 class="box-title">Showing All Permissions</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Permission Name</th>
                  <th>Permission Slug</th>
                  <th>Details</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

                @foreach($permissions as $permission)
                <tr>
                  <td>{!! $permission->name or '---' !!}</td>
                  <td> {!! $permission->slug or '--' !!}</td>
                  <td> {!! $permission->description or '--' !!}</td>
                  <td>
                    <a class="btn btn-primary" href="{!! route('acl.permissions.edit', ['id' => $permission->id ]) !!}">Edit</a>
                    <a class="btn btn-danger" href="#">Delete</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {!! $permissions->links() !!}
          </div>
          <!-- /.box-body -->
        </div>

        @include('acl::layouts.sidebar')
      </div>
    </div>

@stop
