@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-10">
                <a class="btn btn-success pull-right" href="{{ URL::to('acl') }}"> Back </a>
            </div>

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New User</div>
                    <div class="panel-body">

            {!! Form::model($editUsers,array('method' => 'POST', 'route'=>array('acl.user.updateUser', $editUsers),'id'=>'form', 'class' =>'form-horizontal', 'enctype'=>'multipart/form-data')) !!}

                        @if(isset($roles) && count($roles))
                            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Choose Type</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="role" id="role">
                                        @foreach($roles as $role)
                                            <option value="{!! $role->id !!}">{!! $role->name !!}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('role'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <label class="col-md-4 control-label">Full Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ $editUsers->name }}" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Company Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="company_name" value="{{ $editUsers->company_name }}" required>

                                @if ($errors->has('company_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="phone" value="{{ $editUsers->phone }}" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" required>
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ $editUsers->email }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('check') ? ' has-error' : '' }}">
                            <label class="col-md-offset-4 col-md-6">

                                <input id="checkbox6" type="checkbox" name="check" value="agree" required><span class="agree-statement">I agree to <a href="#"><strong class="">Writer Army's</strong></a> terms and conditions.</span>

                            </label>
                            @if ($errors->has('check'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('check') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="text-center">
                            <!-- Trigger the modal with a button -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-btn fa-user"></i>Update
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" style="color: red;">I am Authorized for this Action !</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center">
                                                {!! Form::submit('Submit, Sure?', ['class'=>'btn btn-success']) !!}
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
