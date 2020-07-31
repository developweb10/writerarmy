@extends('acl::layouts.default')

@if(View::hasSection('content-header'))

  @section('content-header')
      <h1>
          <small>Access Portal</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
  @stop
@endif
