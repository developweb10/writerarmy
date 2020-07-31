@extends('dashboard.master')

@section('content-header')
 <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    </ol>
    <h1>
      {!! Config::get('project.companyName') !!} Dashboard
      <small>Welcome!</small>
    </h1>
   
@stop

<style>
    div.sandbox{
        font-size:30px;
    }
</style>

@section('content')


    <div class="row main-dash">
         @can('client.access')
            <div class="col-md-3">
                <a class="btn btn-success col-md-12" href="{{ URL::to('content/menu') }}">
                    <i class="fa fa-external-link"></i><h4>Order Content</h4> <br></a>
            </div>
        @endcan

        @can('writer.access')
            <div class="col-md-3">
                <a class="btn btn-success col-md-12" href="{{ URL::to('jobs') }}">
                    <i class="fa fa-briefcase" aria-hidden="true"></i> <h4>Available Jobs</h4> <br></a>
            </div>
        @endcan

        @can('writer.access')
            <div class="col-md-3">
                <a class="btn btn-success col-md-12" href="{{ URL::to('assignedJobs') }}">
                    <i class="fa fa-briefcase" aria-hidden="true"></i> <h4>My Jobs</h4> <br></a>
            </div>
        @endcan

        @can('client.access')
            <div class="col-md-3">
                <a class="btn btn-success col-md-12" href="{{ URL::to('assignedOrders') }}">
                    <i class="fa fa-sort-amount-asc" aria-hidden="true"></i> <h4>My Order</h4> <br></a>
            </div>
        @endcan
    </div>

    {{--<div class="col-md-12">--}}
        {{--<br><br>--}}
        {{--<div id="sandbox" class="sandbox col-md-12">--}}
            {{--<div class="input-group date" data-date-format="yyyy-mm-dd">--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


@stop

@section('scripts')

<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script>

    $(function () {
            $('.sandbox .input-group.date').datepicker();
            $('.selectpicker').selectpicker();
    });

</script>

@stop