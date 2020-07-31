<!-- Header Navbar -->
<nav class="navbar navbar-static-top" role="navigation">
  <!-- Navbar Right Menu -->
  <div class="navbar-custom-menu">
  	<form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
  
  
    <ul class="nav navbar-nav">
      <!-- Notifications Menu -->
      {{--<li class="dropdown notifications-menu">
        <!-- Menu toggle button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-bell-o"></i>
          <span class="label label-warning">10</span>
        </a>
        <ul class="dropdown-menu">
          <li class="header">You have 10 notifications</li>
          <li>
            <!-- Inner Menu: contains the notifications -->
            <ul class="menu">
              <li><!-- start notification -->
                <a href="#">
                  <i class="fa fa-users text-aqua"></i> 5 new members joined today
                </a>
              </li><!-- end notification -->
            </ul>
          </li>
          <li class="footer"><a href="#">View all</a></li>
        </ul>
      </li>--}}
      <!-- User Account Menu -->
      <li class="dropdown user user-menu">
        <!-- Menu Toggle Button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <!-- The user image in the navbar-->
        @if(isset($user->profile->photo))
            {!! HTML::image(user_photo_path().$user->profile->photo, $user->name, ['class' => 'user-image img-responsive', 'height' => '160', 'width' => '160', 'alt' => 'User profile picture']) !!}
        @else
            {{--{!! HTML::image('components/AdminLTE/dist/img/user222-160x160.jpg', 'User avatar', ['class' => 'user-image' ]) !!}--}}
            {!! HTML::image('frontend/img/user222-160x160.jpg', 'User avatar', ['class' => 'user-image' ]) !!}
        @endif
          <!-- hidden-xs hides the username on small devices so only the image appears. -->
          <span class="hidden-xs">{!! Auth::user()->name !!}</span>
        </a>
        <ul class="dropdown-menu">
          <!-- The user image in the menu -->
          <li class="user-header">
          @if(isset($user->profile->photo))
              {!! HTML::image(user_photo_path().$user->profile->photo, $user->name, ['class' => 'img-circle', 'height' => '160', 'width' => '160', 'alt' => 'User profile picture']) !!}
          @else
              {{--{!! HTML::image('components/AdminLTE/dist/img/user222-160x160.jpg', 'User avatar', ['class' => 'img-circle', 'width' => '160', 'height' => '160' ]) !!}--}}
              {!! HTML::image('frontend/img/user222-160x160.jpg', 'User avatar', ['class' => 'user-image' ]) !!}
          @endif
            <p>
              {!! Auth::user()->name !!}
              <small>Member since {!! date('F d, Y', strtotime(Auth::user()->created_at)) !!}</small>
            </p>
          </li>
          <!-- Menu Body -->
        <?php /*?>  <li class="user-body">
            <div class="col-xs-4 text-center">
              {{-- <a href="#">Followers</a> --}}
            </div>
            <div class="col-xs-4 text-center">
              {{-- <a href="#">Sales</a> --}}
            </div>
            <div class="col-xs-4 text-center">
              {{-- <a href="#">Friends</a> --}}
            </div>
          </li><?php */?>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="{{ url('/profile') }}" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
              <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
            </div>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
