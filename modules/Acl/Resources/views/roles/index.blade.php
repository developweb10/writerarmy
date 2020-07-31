@extends('acl::layouts.master')

@section('content')

    <div class="row col-md-12">
      <div class="container">
        <div class="col-md-12">
          <a class="btn btn-success" href="{!! route('acl.roles.create') !!}"><i class="fa fa-user-plus"></i> Add new Role</a>
        </div>
        <div class="col-md-9">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Showing All Roles</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Role Name</th>
                    <th>Role Slug</th>
                    <th>Details</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach($roles as $role)
                  <tr>
                    <td>{!! $role->name or '---' !!}</td>
                    <td> {!! $role->slug or '--' !!}</td>
                    <td> {!! $role->description or '--' !!}</td>
                    <td>
                      <a class="btn btn-primary" href="{!! route('acl.roles.edit', ['id' => $role->id ]) !!}">Edit</a>
                      <a class="btn btn-danger" href="#">Delete</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        @include('acl::layouts.sidebar')
      </div>      
    </div>

@stop
