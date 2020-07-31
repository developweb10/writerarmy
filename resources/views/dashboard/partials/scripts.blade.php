<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 2.1.4 -->
{!! HTML::script('components/jquery/dist/jquery.min.js') !!}
<!-- Bootstrap 3.3.5 -->
{!! HTML::script('components/bootstrap/dist/js/bootstrap.min.js') !!}
<!-- Select2 -->
{!! HTML::script('components/select2/dist/js/select2.min.js') !!}
<!-- AdminLTE App -->
{!! HTML::script('components/AdminLTE/dist/js/app.min.js') !!}

{!! HTML::script('js/bootstrap-datepicker.js') !!}

{!! HTML::script('js/nicEdit-latest.js') !!}






<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

<!-- To verify CSRF Token for AJAX Request -->
<script type="text/javascript">
      $.ajaxSetup({
                  headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
       });
</script>

@yield('scripts')
</script><!--  <script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { new nicEditor({fullPanel : true}).panelInstance('area1');});
  //]]>
  </script> -->

@stack('partial-scripts')

