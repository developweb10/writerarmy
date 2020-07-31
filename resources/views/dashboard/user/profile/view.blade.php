@extends('dashboard.master')

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
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              @if(@$user->profile && $user->profile->photo)
                {!! HTML::image(user_photo_path().$user->profile->photo, $user->name, ['class' => 'profile-user-img img-responsive', 'height' => '160', 'width' => '160', 'alt' => 'User profile picture']) !!}
              @else
                <img class="profile-user-img img-responsive" src="http://placehold.it/128x128" alt="User profile picture" width="128" height="128">
              @endif

              <h3 class="profile-username text-center">{!! $user->name !!}</h3>

              <p class="text-muted text-center">{{ $user->company_name }}</p>
              <hr>
              <p class="text-muted text-center">
                Website:
                @if($user->profile && $user->profile->website != null)
                 <a href="{!! $user->profile->website !!}">{!! $user->profile->website !!}</a>
                @endif
              </p>

              <a href="{!! route('user.edit') !!}" class="btn btn-warning btn-block"><i class="fa fa-pencil"></i> <b>Edit</b></a>
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
              <div class="box-body details-ps">

                <h3><i class="fa fa-user margin-r-5"></i> Personal</h3>

                <p class="text-muted">
                <strong>Full Name :</strong> {{ $user->name }}
                </p>

                <p class="text-muted">
                <strong>Email :</strong> {{ $user->email }}
                </p>

                <p class="text-muted">
                <strong>Alternate Email :</strong> {{ $user->profile->alternate_email or '' }}
                </p>

                <p class="text-muted">
                <strong>Phone :</strong> {{ $user->phone }}
                </p>

                <p class="text-muted">
                <strong>Birthday :</strong> {{ $user->profile->date_of_birth or '' }}
                </p>

                <p class="text-muted">
                <strong>Gender :</strong> {{ $user->profile->gender or '' }}
                </p>

                <hr>

                <h3><i class="fa fa-map-marker margin-r-5"></i> Location</h3>

                <p class="text-muted">{{ $user->profile->address or '' }}</p>

                <hr>

                <h3><i class="fa fa-flask margin-r-5"></i> Industry</h3>

                <p>
                    @foreach($user->skills as $skill)
                        <span class="label label-success">{{ $skill->name }}</span>
                    @endforeach
                </p>

                <hr>

                <h3><i class="fa fa-file-text-o margin-r-5"></i> About</h3>

                <p>{!! $user->profile->about or '' !!}</p>
            </div>
          </div>
        </div>
    </div>
@stop
