<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{!! Config::get('project.companyName') !!} | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    @include('dashboard.partials.stylesheets')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	@yield('pagespecificscripts')
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-43760162-1"></script>
  <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-43760162-1');
 
  </script>
  </head>
  <body class="hold-transition skin-blue sidebar-mini top-theme">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="{!! URL::route('dashboard') !!}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>EC</b>ABC</span>
          <!-- logo for regular state and mobile devices -->

          <span class="logo-lg" style="margin-left: -15px">{!! HTML::image('global/img/logo.png', 'EasyChecklistABC', ['width' => '230', 'height' => '60']) !!}</span>
        </a>
        @include('dashboard.partials.nav')
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      @include('dashboard.partials.sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <section class="content-header">
        <!-- Content Header (Page header) -->
          @yield('content-header')
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          @include('flash::message')
          @include('dashboard.partials.error')
          @yield('content')
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; {!! date('Y') !!} <a href="{!! URL::route('dashboard') !!}">{{ Config::get('project.companyName') }}</a>.</strong> All rights reserved.
      </footer>

    </div><!-- ./wrapper -->
    @include('dashboard.partials.scripts')
    <!-- Global site tag (gtag) - Google Ads: 976488330 --> 
    <amp-analytics type="gtag" data-credentials="include">
    <?php 
      $currenturl = Request::fullUrl();
      $currenturl = explode("/",$currenturl);
      $total = count($currenturl);
      $transactionid= $currenturl[$total-1];
      $urlcheck = $currenturl[$total-2];

    if($urlcheck == 'thank-you' || $urlcheck == 'confirmation'){ ?>
         <script type="application/json"> { "vars": { "gtag_id": "AW-976488330", "config": { "AW-976488330": { "groups": "default" } } }, "triggers": {"C_GiOVxJU9LRU": { "on": "visible", "vars": { "event_name": "conversion", "transaction_id": "", "send_to": ["AW-976488330/<?php echo $transactionid; ?>"] } }

     } } </script> 
     <?php 
    }else{ ?>
 <script type="application/json"> { "vars": { "gtag_id": "AW-976488330", "config": { "AW-976488330": { "groups": "default" } } }, "triggers": {

     } } </script> 

    <?php }
    ?>
      
   </amp-analytics>
  </body>
</html>
