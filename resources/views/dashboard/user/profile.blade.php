@extends('dashboard.master')

@section('content-header')
 <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol> 
    <h1>
      <small>User Profile</small>
    </h1>
   
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">

              <h3 class="profile-username text-center">Nina Mcintire</h3>

              <p class="text-muted text-center">Software Engineer</p>
              <hr>
              <p class="text-muted text-center">Website: </p>

              <a href="{!! route('user.edit') !!}" class="btn btn-warning btn-block"><i class="fa fa-pencil"></i> <b>Edit</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-9">
          <div class="box box-primary">
              <div class="box-header">
                <h4>Profile details</h4>
              </div>
              <div class="box-body">

                <strong><i class="fa fa-user margin-r-5"></i> Personal</strong>

                <p class="text-muted">
                <br>
                <strong>Full Name :</strong> @{{ name }}
                </p>

                <p class="text-muted">
                <strong>Email :</strong> @{{ email }}
                </p>

                <p class="text-muted">
                <strong>Alternate Email :</strong> @{{ alternate_email }}
                </p>

                <p class="text-muted">
                <strong>Phone :</strong> @{{ phone }}
                </p>

                <p class="text-muted">
                <strong>Birthday :</strong> @{{ date_of_birth }}
                </p>

                <p class="text-muted">
                <strong>Gender :</strong> @{{ gender }}
                </p>

                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                <p class="text-muted">@{{ address }}</p>

                <hr>

                <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

                <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
                </p>

                <hr>

                <strong><i class="fa fa-file-text-o margin-r-5"></i> About</strong>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
          </div>
        </div>
    </div>
@stop