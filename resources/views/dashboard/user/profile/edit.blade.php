@extends('dashboard.master')

@section('styles')
<!-- jQuery UI -->
{!! HTML::style('components/jquery-ui/themes/base/jquery-ui.min.css') !!}
{!! HTML::style('components/jquery-ui/themes/base/theme.css') !!}
@stop

@section('content-header')
 <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
    <h1>
      User Profile
    </h1>
   
@stop

@section('content')
    <div class="row user-profile-holder">
      {!! Form::model($user, ['route' => ['user.update', $user->id], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'put', 'files' => true]) !!}
        <div class="col-md-3">
 
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <p class="lead">Current photo</p>
              @if(@$user->profile && $user->profile->photo)
                {!! HTML::image(user_photo_path().$user->profile->photo, $user->name, ['class' => 'profile-user-img img-responsive', 'height' => '160', 'width' => '160', 'alt' => 'User profile picture']) !!}
              @else
                <img class="profile-user-img img-responsive" src="http://placehold.it/128x128" alt="User profile picture" width="128" height="128">
              @endif

              <hr>
              <div class="spacer-left-right">{!! Form::file('photo', ['id' => 'photo']) !!}
              <p class="help-block small">Upload your photo in jpg/png format. Maximum size 512 KB</p>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-9 profile-infomrmer">
          <div class="box box-primary">
              <div class="box-header">
                <h4>Profile details</h4>
              </div>
              <div class="box-body">

                <h3><i class="fa fa-user margin-r-5"></i> Personal</h3>

                <br>
                <div class="col-md-12">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="name" class="control-label small">Full Name</label>
                        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter your full name', 'required' => 'required']) !!}
                        <p class="help-block small">Enter your full name</p>
                    </div>
                  </div>
                  <div class="col-md-7"></div>
                </div>

                <div class="col-md-12">
                  <div class="col-md-5">
                    <div class="form-group">
                        <label for="name" class="control-label small">Company Name</label>
                        {!! Form::text('company_name', null, ['class' => 'form-control', 'id' => 'company_name', 'placeholder' => 'Enter your company name', 'required' => 'required']) !!}
                        <p class="help-block small">Enter your company name</p>
                    </div>
                  </div>
                  <div class="col-md-offset-1 col-md-5">
                    <div class="form-group">
                        <label for="occupation" class="control-label small">Job Title</label>
                        {!! Form::text('occupation', @$user->profile->occupation, ['class' => 'form-control', 'id' => 'occupation', 'placeholder' => 'Enter your job title']) !!}
                        <p class="help-block small">Enter your Job title</p>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="col-md-5">
                    <div class="form-group">
                        <label for="email" class="control-label small">Email</label>
                        {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Enter your email address', 'required' => 'required']) !!}
                        <p class="help-block small">Enter your email address</p>
                    </div>
                  </div>
                  <div class="col-md-offset-1 col-md-5">
                    <div class="form-group">
                        <label for="alternate_email" class="control-label small">Alternate Email</label>
                        {!! Form::email('alternate_email', @$user->profile->alternate_email, ['class' => 'form-control', 'id' => 'alternate_email', 'placeholder' => 'Enter your alternate email address']) !!}
                        <p class="help-block small">Enter your alternate email</p>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="col-md-5">
                    <div class="form-group">
                        <label for="phone" class="control-label small">Phone</label>
                        {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone', 'placeholder' => 'Enter your phone number']) !!}
                        <p class="help-block small">Enter your phone number</p>
                    </div>
                  </div>
                  <div class="col-md-offset-1 col-md-5">
                    <div class="form-group">
                        <label for="date_of_birth" class="control-label small">Birthday</label>
                        {!! Form::text('date_of_birth', @$user->profile->date_of_birth, ['class' => 'form-control datepicker', 'id' => 'date_of_birth', 'placeholder' => 'MM-DD-YYYY']) !!}
                        <span class="small help-block" id="age"></span>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="col-md-5">
                    <div class="form-group">
                        <label for="gender" class="control-label small">Gender</label>
                        <p>
                          {!! Form::radio('gender', 'female', ['required' => 'required']) !!} Female <br>
                          {!! Form::radio('gender', 'male', ['required' => 'required', 'checked' => 'true']) !!} Male <br>
                        </p>
                    </div>
                  </div>
                  <div class="col-md-7"></div>
                </div>

                <hr>

                <h3><i class="fa fa-map-marker margin-r-5"></i> Address</h3>

                <div class="col-md-12">
                  <div class="col-md-5">
                    <div class="form-group">
                        {!! Form::textarea('address', @$user->profile->address, ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Enter your address', 'rows' => 3]) !!}
                        <p class="help-block small">Enter your address details</p>
                    </div>
                  </div>
                  <div class="col-md-7"></div>
                </div>

                <hr>

                <h3><i class="fa fa-flask margin-r-5"></i> Industry</h3>

                <div class="col-sm-12"><p>
                    @foreach($user->skills as $skill)
                        <span class="label label-success">{{ $skill->name }}</span>
                    @endforeach
                </p></div>

                <div class="col-md-12">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label for="skills">Set Industries</label>

                          {{ Form::select('skills[]', $skills, null, ['class' => 'form-control select-dropdown', 'id' => 'skills', 'multiple' => 'multiple']) }}
                        <p class="help-block small">Choose from the skills that matches</p>
                    </div>
                  </div>
                  <div class="col-md-7"></div>
                </div>
                <hr>

                <h3><i class="fa fa-file-text-o margin-r-5"></i> About</h3>

                <div class="col-md-12">
                  <div class="col-md-5">
                    <div class="form-group">
                        {!! Form::textarea('about', @$user->profile->about, ['class' => 'form-control', 'id' => 'about', 'placeholder' => 'Enter your about details', 'rows' => 3]) !!}
                        <p class="help-block small">Enter a short description about yourself</p>
                    </div>
                  </div>
                  <div class="col-md-7"></div>
                </div>

                <div class="col-md-12">
                  <div class="col-md-5">
                    <div class="form-group">
                        <label class="control-label small">Website</label>
                        {!! Form::text('website', @$user->profile->website, ['class' => 'form-control', 'id' => 'website', 'placeholder' => 'http://', 'rows' => 3]) !!}
                        <p class="help-block small">Enter your website url</p>
                    </div>
                  </div>
                  <div class="col-md-7"></div>
                </div>


                <div class="col-md-12">
                  <div class="col-md-5">
                    <div class="form-group">
                        <label class="control-label small">Payment</label>
                        <input type="text" value="<?php if(isset($getWriter[0]->paypal_email)) { echo $getWriter[0]->paypal_email; } ?>" name="paypal_email" class="form-control" />
                        <p class="help-block small">Enter your paypal email</p>
                    </div>
                  </div>
                  <div class="col-md-7"></div>
                </div>

                <div class="col-md-12">
                  <div class="col-md-5">
                      <div class="form-group">
                          <label class="control-label small">Change Password: </label>

                          <a class="btn-xs btn-success" href="{{ route('access.user.password', \Illuminate\Support\Facades\Auth::User()->id) }}">
                              <i class="fa fa-key" aria-hidden="true"></i> Change
                          </a>
                      </div>
                  </div>
                  <div class="col-md-7"></div>
                </div>


                <div class="col-md-12">
                  <hr>
                  <div class="form-group">
                    <div class="col-sm-3">
                      <button type="submit" class="btn btn-primary blue-main-btn">Save</button>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop


@section('scripts')
  {!! HTML::script('components/jquery-ui/jquery-ui.min.js') !!}
  <script>
    $(document).ready(function() {
        $(".select-dropdown").select2({
            placeholder: "Select a skill",
            allowClear: true
        });
    });

    $(function() {
      $( ".datepicker" ).datepicker({
          changeYear: true,
          yearRange: "-70:-10",
          defaultDate : '-10y'
      });
    });
  </script>

@stop