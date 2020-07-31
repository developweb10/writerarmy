<div class="col-md-9">
    <div>
        <h2 class="text-center">Add new Permission</h2>
        <br>
    </div>

    @if(isset($permission))
    {!! Form::model(@$permission, ['route' => ['acl.permissions.update', @$permission->id],
                                'method' => 'PUT', 'class' => 'form-horizontal',
                                'role' => 'form']) !!}
    @else
    {!! Form::open(['route'=>'acl.permissions.store',
                    'class' =>'form col-md-12' ]) !!}
    @endif

    <div class="container-fluid col-md-12">
        <div class="col-md-12">
            <label class="control-label col-md-4"> Permission Name :</label>
            <div class="col-md-8">
                {!! Form::text('name', null,['class'=>'form-control','placeholder'=>'Permission Name']) !!}
                <br>
            </div>
        </div>

        <div class="col-md-12">
            <label class="control-label col-md-4"> Permission Slug :</label>
            <div class="col-md-8">
                {!! Form::text('slug', null,['class'=>'form-control','placeholder'=>'Write Permission Slug']) !!}
                <br>
            </div>
        </div>

        <div class="col-md-12">
            <label class="control-label col-md-4"> Description : </label>
            <div class="col-md-8">
                {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
                <br>
            </div>
        </div>

        <div class="col-md-12">
            <label class="control-label col-md-4"> Model name (not mandatory) : </label>
            <div class="col-md-8">
                {!! Form::text('model', null,['class'=>'form-control','placeholder'=>'Permission module name (not mandatory)']) !!}
                <br>
            </div>
        </div>

        <div class="col-md-12 text-center">
            {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
            <a class="btn btn-danger" href="{!! URL::previous() !!}">Back</a>
        </div>

    {!! Form::close() !!}

    </div>
</div>
