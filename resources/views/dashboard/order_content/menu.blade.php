@extends('dashboard.master')

@section('content-header')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Content Menu</li>
    </ol>
@stop

<style>
    .fa {
        padding-right: 8px;
    }
</style>

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="col-md-12 page-heading">
            <label>
                <h3><u>Order Content (Please <a href="{{ url('/depositFunds') }}">Deposit Funds</a> first to place an order)</u>
                    <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                </h3>
                <br>
            </label>
        </div>
    
        <div class="col-md-12 order-listing">
         <div class="row">
            @foreach($contents as $package)
                <div class="col-sm-4">
                    <a href="{{ $package->id }}">
                        <i class="{{ $package->icon }}" aria-hidden="true"></i>
                        <strong> {{ $package->title }}</strong>
                    </a>
                </div>
               @endforeach
               </div>
        </div>
    </div>
</div>
@stop

@section('scripts')

@stop