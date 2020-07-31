
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
        @if(isset($user->profile->photo))
            {!! HTML::image(user_photo_path().$user->profile->photo, $user->name, ['class' => 'img-circle img-responsive', 'height' => '160', 'width' => '160', 'alt' => 'User profile picture']) !!}
        @else
            {{--{!! HTML::image('components/AdminLTE/dist/img/user222-160x160.jpg', 'User avatar', ['class' => 'img-circle' ]) !!}--}}
            {!! HTML::image('frontend/img/user222-160x160.jpg', 'User avatar', ['class' => 'user-image' ]) !!}
        @endif
        </div>
        <div class="pull-left info">
          <p>{!! Auth::user()->name !!}</p>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        {{--<li class="treeview">--}}
          {{--<a href="#">--}}
            {{--<i class="fa fa-edit"></i> <span>Blogs</span>--}}
            {{--<i class="fa fa-angle-left pull-right"></i>--}}
          {{--</a>--}}
          {{--<ul class="treeview-menu">--}}
            {{--<li><a href="{!! URL::route('dashboard.blog.create') !!}"><i class="fa fa-circle-o"></i> Create New Article</a></li>--}}
            {{--<li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Manage Articles</a></li>--}}
          {{--</ul>--}}
        {{--</li>--}}


        @can('client.access')
          @can('writer.access')
          <li class="btn-danger">
              <a href="{!!url('acl')!!}"><i class="fa fa-cogs" aria-hidden="true"></i>
                  <span>Access Management</span>
              </a>
          </li>
           <li class="treeview">
              <a href="{!! URL::to('list') !!}">
                  <i class="fa fa-sort-amount-asc" aria-hidden="true"></i> <span>Services</span>
              </a>
          </li>
           <li class="treeview">
              <a href="{!! URL::to('messages') !!}">
                  <i class="fa fa-sort-amount-asc" aria-hidden="true"></i> <span>Messages</span>
              </a>
          </li>
             <li class="treeview">
              <a href="{!! URL::to('writers') !!}">
                  <i class="fa fa-sort-amount-asc" aria-hidden="true"></i> <span>Writer</span>
              </a>
          </li>
            <li class="treeview">
              <a href="{!! URL::to('users') !!}">
                  <i class="fa fa-sort-amount-asc" aria-hidden="true"></i> <span>Users</span>
              </a>
          </li>
          @endcan
        @endcan


        @can('client.access')
          @can('writer.access')
          {{--<li class="treeview">--}}
              {{--<a href="{!! URL::to('package') !!}">--}}
                  {{--<i class="fa fa-wrench" aria-hidden="true"></i> <span>Package Setting</span>--}}
              {{--</a>--}}
          {{--</li>--}}

          <li class="treeview">
              <a href="{!! URL::to('allOrders') !!}">
                  <i class="fa fa-object-ungroup" aria-hidden="true"></i> <span>All Orders</span>
              </a>
          </li>

          <li class="treeview">
              <a href="{!! URL::to('allJobs') !!}">
                  <i class="fa fa-bars" aria-hidden="true"></i> <span>All Jobs</span>
              </a>
          </li>

          <li class="header"> </li>
          @endcan
        @endcan


        @can('client.access')
          <li class="treeview">
              <a href="{!! URL::to('content/menu') !!}">
                  <i class="fa fa-external-link"></i> <span>Order Content</span>
              </a>
          </li>
        @endcan


        @can('writer.access')
          <li class="treeview">
              <a href="{!! URL::to('jobs') !!}">
                  <i class="fa fa-briefcase" aria-hidden="true"></i> <span>Available Jobs</span>
              </a>
          </li>
        @endcan

        @can('writer.access')
          <li class="treeview">
              <a href="{!! URL::to('assignedJobs') !!}">
                  <i class="fa fa-briefcase" aria-hidden="true"></i> <span>My Jobs</span>
              </a>
          </li>
        @endcan

        @can('writer.access')
          <li class="treeview">
              <a href="#">
                  <i class="fa fa-signal" aria-hidden="true"></i><span> Jobs in Progress </span>
                  <i class="fa fa-hand-o-down" aria-hidden="true"></i>
              </a>
              <ul class="treeview-menu" style="display: none;">
                  {{--<li class="">--}}
                      {{--<a href="{!! URL::to('myJobs/screeningView') !!}"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> SCREENING </a>--}}
                  {{--</li>--}}
                  <li class="">
                      <a href="{!! URL::to('myJobs/writingView') !!}"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> WRITING </a>
                  </li>
                  <li class="">
                      <a href="{!! URL::to('myJobs/draftReadyView') !!}"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> DRAFT READY </a>
                  </li>
                  <li class="">
                      <a href="{!! URL::to('myJobs/revisingView') !!}"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> REVISING </a>
                  </li>
                  <li class="">
                      <a href="{!! URL::to('myJobs/finalReadyView') !!}"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> FINAL READY </a>
                  </li>
                  <li class="">
                      <a href="{!! URL::to('myJobs/acceptedView') !!}"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> ACCEPTED </a>
                  </li>
              </ul>
          </li>
        @endcan


        @can('client.access')
          <li class="treeview">
              <a href="{!! URL::to('assignedOrders') !!}">
                  <i class="fa fa-sort-amount-asc" aria-hidden="true"></i> <span>My Orders</span>
              </a>
          </li>          
        @endcan

        {{--@can('client.access')--}}
          {{--<li class="treeview">--}}
              {{--<a href="#">--}}
                  {{--<i class="fa fa-pie-chart" aria-hidden="true"></i><span> View Order Status </span>--}}
                  {{--<i class="fa fa-hand-o-down" aria-hidden="true"></i>--}}
              {{--</a>--}}
              {{--<ul class="treeview-menu" style="display: none;">--}}
                  {{--<li class="">--}}
                      {{--<a href="{!! URL::to('assignedOrders/screeningView') !!}"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> SCREENING </a>--}}
                  {{--</li>--}}
                  {{--<li class="">--}}
                      {{--<a href="{!! URL::to('assignedOrders/writingView') !!}"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> WRITING </a>--}}
                  {{--</li>--}}
                  {{--<li class="">--}}
                      {{--<a href="{!! URL::to('assignedOrders/draftReadyView') !!}"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> DRAFT READY </a>--}}
                  {{--</li>--}}
                  {{--<li class="">--}}
                      {{--<a href="{!! URL::to('assignedOrders/revisingView') !!}"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> REVISING </a>--}}
                  {{--</li>--}}
                  {{--<li class="">--}}
                      {{--<a href="{!! URL::to('assignedOrders/finalReadyView') !!}"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> FINAL READY </a>--}}
                  {{--</li>--}}
                  {{--<li class="">--}}
                      {{--<a href="{!! URL::to('assignedOrders/acceptedView') !!}"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> ACCEPTED </a>--}}
                  {{--</li>--}}
              {{--</ul>--}}
          {{--</li>--}}
        {{--@endcan--}}

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
