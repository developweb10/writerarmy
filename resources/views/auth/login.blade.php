@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row register-log-page">
        <div class="col-md-7 center-block float-none">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {!! csrf_field() !!}

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
                         <div class="form-group">
                            <div class="col-md-3 text-right">
                            </div>
                                <div class="col-md-9 text-right">
                                <div class="g-recaptcha" data-sitekey="6LdWRL8UAAAAADLyhUxtTyMfu14O5iFqNMcMk1E4"></div>
                                </div>
                        </div>                            

                        <div class="form-group col-md-6">
                            <div class="">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6 text-right">
                            <div class="">
                                <button type="submit" class="loginbtn btn btn-primary blue-main-btn">
                                    <i class="fa fa-btn fa-sign-in"></i>Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src='https://www.google.com/recaptcha/api.js' async defer ></script>

@endsection
