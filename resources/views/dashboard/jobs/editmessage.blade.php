@extends('dashboard.master')

@section('content-header')
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> Edit Message</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-12">
                    <?php //print_r($message) ;?>
                       <div class="form-group"> <label for="Message">Message:</label>  <div class="form-control">{{$message->body}} </div>
                        <div class="form-group"> <label for="Message">From User:</label>  <div class="form-control">{{$message->from_user}} </div>
                         <div class="form-group"> <label for="Message">To User:</label>  <div class="form-control">{{$message->to_user}} </div>
                       @if($message->attachment != '')
                       <?php $array = explode('/',$message->attachment); $key = count($array)-1; ?>
                          <div class="form-group"> <label for="Message">Attachment:</label>  <div class="form-control"> <p><u>Attachment</u> : <a href="{{ url($message->attachment)}}" download><?php echo $array[$key]; ?></a></p></div> @endif
                                             
                        <form method="post" action="{{ url('/updatemessage/')}}">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="hidden" name="id" value="{{$message->id}}" />
                           
                           <div class="form-group">
                            <label for="status">Status:</label>    
                           <select name="status"  class="form-control" >
                             <option value="0" <?php if($message->status == 0){ echo 'selected="selected"'; } ?>>Unapproved</option>
                             <option value="1"  <?php if($message->status == 1){ echo 'selected="selected"'; } ?>>Approved</option>
                           </select>
                           </div>
                           <input type="submit" name="update"  class="btn btn-default"  value="Update" />
                        </form>
                        
                   
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@stop



