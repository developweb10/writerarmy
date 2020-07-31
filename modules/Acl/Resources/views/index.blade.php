@extends('acl::layouts.master')

@section('content')

    <div class="row col-md-12">
      <div class="container">
        <div class="box col-md-9">
          <div class="box-header">
            <h3 class="box-title">Showing All Users</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>User Name</th>
                  <th>User Role</th>
                  {{--<th>Current User Access</th>--}}
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

                @foreach($users as $user)
                <tr>
                  <td>{!! $user->name or '---' !!}</td>
                  <td>
                    @foreach($user->roles as $role)
                    <small class="label label-default">{!! $role->name or '' !!}</small>
                    @endforeach
                  </td>
                  {{--<td>--}}
                      {{--@can('user.create')--}}
                          {{--<small class="label label-info">--}}
                            {{--User create--}}
                          {{--</small>--}}
                      {{--@endcan--}}
                  {{--</td>--}}
                  <td>
                    <a class="btn btn-primary" href="{!! route('acl.user.roles', ['id' => $user->id ]) !!}">Assign Roles</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        
        @include('acl::layouts.sidebar')
      </div>
    </div>

@stop
