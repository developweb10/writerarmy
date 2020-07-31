@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row register-log-page">
        <div class="col-md-8 center-block float-none">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="status" value="0" /> 

                        @if(isset($roles) && count($roles))
                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Choose Type</label>

                            <div class="col-md-9">
                                <select class="form-control" name="role" id="role">
                                    @foreach($roles as $role) 
                                    @if($role->id == 2)
                                    <option value="{!! $role->id !!}">{!! $role->name !!}</option>
                               @endif
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

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Full Name</label>

                            <div class="col-md-9">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Company Name</label>

                            <div class="col-md-9">
                                <input type="text" class="form-control" name="company_name" value="{{ old('company_name') }}">

                                @if ($errors->has('company_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Phone</label>

                            <div class="col-md-9">
                        <input type="number" pattern=".{10,}" maxlength="10" minlength="10"  id="phonenumber" class="form-control" name="phone" value="{{ old('phone') }}" required title="10 characters minimum">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">E-Mail Address</label>

                            <div class="col-md-9">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Password</label>

                            <div class="col-md-9">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Confirm Password</label>

                            <div class="col-md-9">
                                <input type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-6{{ $errors->has('check') ? ' has-error' : '' }}">
                            <label class="col-md-12 checkbox">

                                <input id="checkbox6" type="checkbox" name="check" value="agree"><span class="agree-statement">I agree to <a href="https://www.writerarmy.com/terms/" target="_blank"><strong class="">WriterArmy's</strong></a>
                               <a href="https://www.writerarmy.com/terms/"> terms and conditions</a>.</span>

                            </label>
                            @if ($errors->has('check'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('check') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-6 text-right">
                            <div class="">
                                <button type="submit" class="btn btn-primary blue-main-btn" id="submitbtn">
                                    <i class="fa fa-btn fa-user"></i>Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
