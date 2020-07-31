<!-- Bootstrap 3.3.5 -->
{!! HTML::style('components/bootstrap/dist/css/bootstrap.min.css') !!}
<!-- Font Awesome -->
{!! HTML::style('components/font-awesome/css/font-awesome.min.css') !!}
<!-- Ionicons -->
{!! HTML::style('components/Ionicons/css/ionicons.min.css') !!}
<!-- Select2 -->
{!! HTML::style('components/select2/dist/css/select2.min.css') !!}
<!-- Theme style -->
{!! HTML::style('components/AdminLTE/dist/css/AdminLTE.min.css') !!}
<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
      page. However, you can choose any other skin. Make sure you
      apply the skin class to the body tag so the changes take effect.
-->
{!! HTML::style('components/AdminLTE/dist/css/skins/skin-blue.min.css') !!}

@yield('styles')
@stack('partial-styles')
