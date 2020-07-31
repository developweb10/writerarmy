<div class="col-md-9">
    <div>
        <h2 class="text-center">Assign Permissions into Role</h2>
        <br>
    </div>
    @if(isset($role))
    {!! Form::model(@$role, ['route' => ['acl.roles.update', @$role->id],
                                'method' => 'PUT', 'class' => 'form-horizontal',
                                'role' => 'form']) !!}
    @else
    {!! Form::open(['route'=>'acl.roles.store',
                    'class' =>'form col-md-12' ]) !!}
    @endif



    <div class="container-fluid col-md-12">
      <div class="col-md-5">
        <div class="form-group">
            <label class="control-label"> Role Name :</label>
            <div class="">
                {!! Form::text('name', null,['class'=>'form-control','placeholder'=>'Role Name']) !!}
                <br>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label"> Role Slug :</label>
            <div class="">
                {!! Form::text('slug', null,['class'=>'form-control','placeholder'=>'Write Role Slug']) !!}
                <br>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label"> Description : </label>
            <div class="">
                {!! Form::textarea('description', null, ['class'=>'form-control', 'rows' => 6]) !!}
                <br>
            </div>
        </div>
        <div class="form-group text-center">
            {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
            <a class="btn btn-danger" href="{!! URL::previous() !!}">Back</a>
        </div>
      </div>
      <div class="col-md-offset-2 col-md-5">
        <div class="">
            <label class="control-label">
                <h3 class="pull-left"><u> Permissions :</u></h3>
            </label>
            <div class="" style="overflow-y: scroll; height: 360px;">
                @foreach($permissions as $permission)
                  @if(isset($role) && $role->hasPermission($permission->slug))
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" checked="checked">
                    {{ $permission->name or '' }}
                  @else
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                    {{ $permission->name or '' }}
                  @endif
                    <br>
                @endforeach
                <br><br><br>
            </div>
        </div>
      </div>

    {!! Form::close() !!}

    </div>
</div>
