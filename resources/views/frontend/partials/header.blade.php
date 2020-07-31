  <!-- Header BEGIN -->
  <div class="header header-mobi-ext">
    <div class="container">
      <div class="row">
        <!-- Logo BEGIN -->
        <div class="col-md-2 col-sm-2">
          <a class="scroll site-logo" href="#promo-block">
             {!! HTML::image('global/img/logo.png', Config::get('project.front.title')) !!}
          </a>
        </div>
        <!-- Logo END -->
        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>
        <!-- Navigation BEGIN -->
        <div class="col-md-10 pull-right">
          <ul class="header-navigation">
            <li class=""><a href="{!! URL::route('home') !!}">Home</a></li>
            <li><a href="{!! URL::route('home') !!}#demo">How it Works</a></li>
            <li><a href="{!! URL::route('home') !!}#services">Who Can Use This?</a></li>
            <li><a href="{!! URL::route('blog.index') !!}">Blog</a></li>
            <li><a href="{!! URL::route('home') !!}#prices">Pricing</a></li>
            <li>
              @if (Auth::guest())
              <li>{!! HTML::link('/login', 'Sign In') !!}</li>
                
              @else
              <li>{!! HTML::link('/logout', 'Sign Out') !!}</li>
              @endif
            </li>
          </ul>
        </div>
        <!-- Navigation END -->
      </div>
    </div>
  </div>
  <!-- Header END -->