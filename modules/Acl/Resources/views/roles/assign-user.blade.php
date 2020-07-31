@extends('acl::layouts.master')

@section('content')

  <div class="row col-md-12">
    <div class="container">
      <div class="box">
        <div class="well well-md box-header">
          <h3 class="box-title"> Update Assign Role</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="col-md-9">
              <div>
                  <h2 class="text-center">Assign Role to User</h2>
                  <br>
              </div>

              {!! Form::open(['route'=>['acl.user.roles.store', @$user->id], 'method' => 'POST',
                              'class' =>'form col-md-12' ]) !!}

              <div class="container-fluid col-md-12">
                  <div class="col-md-12">
                      <label class="control-label col-md-4"> User Name :</label>
                      <div class="col-md-8">
                          {!! Form::text('user_name', @$user->name, ['class'=>'form-control','placeholder'=>'Role Name', 'disabled']) !!}
                          <br>
                      </div>
                  </div>

                  <div class="col-md-12">
                      <label class="control-label col-md-12">
                          <h3 class="pull-left"><u> Roles :</u></h3>
                      </label>
                      <div class="col-md-8">
                          @foreach($roles as $role)
                            @if(isset($user) && $user->hasRole($role->slug))
                              <input type="checkbox" name="roles[]" value="{{ $role->id }}" checked="checked">
                              {{ $role->name or '' }}
                            @else
                              <input type="checkbox" name="roles[]" value="{{ $role->id }}">
                              {{ $role->name or '' }}
                            @endif
                              <br>
                          @endforeach
                          <br><br><br>
                      </div>
                  </div>
                  <div class="col-md-12 text-center">
                      {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
                      <a class="btn btn-danger" href="{!! URL::previous() !!}">Back</a>
                  </div>

              {!! Form::close() !!}

              </div>
          </div>

          @include('acl::layouts.sidebar')
        </div>
        <!-- /.box-body -->
      </div>
    </div>
</div>

@stop


@section('scripts')

@stop
