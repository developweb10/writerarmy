
  <!--[if lt IE 9]>
  <script src="global/plugins/respond.min.js"></script>
  <![endif]-->
  <!-- Load JavaScripts at the bottom, because it will reduce page load time -->
  <!-- Core plugins BEGIN (For ALL pages) -->
  {!! HTML::script('components/jquery/dist/jquery.min.js') !!}
  {!! HTML::script('components/jquery-migrate-1.3.0/index.js') !!}
  {!! HTML::script('components/bootstrap/dist/js/bootstrap.min.js') !!}
  <!-- Core plugins END (For ALL pages) -->
  <!-- END RevolutionSlider -->
  <!-- Core plugins BEGIN (required only for current page) -->
  {!! HTML::script('components/jparallax/js/jquery.parallax.min.js') !!}
  {!! HTML::script('frontend/scripts/jquery.nav.js') !!}
  <!-- Core plugins END (required only for current page) -->
  <!-- Global js BEGIN -->
  {!! HTML::script('frontend/scripts/layout.js') !!}
  <script>
    $(document).ready(function() {
      Layout.init();
    });
  </script>
  <!-- Global js END -->