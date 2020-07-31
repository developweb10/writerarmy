<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>
  <meta charset="utf-8">
  <title>{!! Config::get('project.front.title') !!}</title>

  @include('frontend.partials.meta')

  <link rel="shortcut icon" href="favicon.ico">
  <!-- Fonts START -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Pathway+Gothic+One|PT+Sans+Narrow:400+700|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
  <!-- Fonts END -->
  @include('frontend.partials.stylesheets')
</head>
<!--DOC: menu-always-on-top class to the body element to set menu on top -->
<body>

  @include('frontend.partials.header')

  <div id="promo-block"></div>

  @yield('content')

  <!-- BEGIN PRE-FOOTER -->
  <div class="pre-footer" id="contact">
    <div class="container">
      <div class="row">
      </div>
    </div>
  </div>
  <!-- END PRE-FOOTER -->
  @include('frontend.partials.footer')

  <a href="#promo-block" class="go2top scroll"><i class="fa fa-arrow-up"></i></a>
  @include('frontend.partials.scripts')
</body>
</html>