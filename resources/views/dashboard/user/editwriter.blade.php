@extends('dashboard.master')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Edit</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="form-group"> <label for="Message">Name:</label>  <div class="form-control">{{$user->name}} </div>
                      <div class="form-group"> <label for="Message">Email:</label>  <div class="form-control">{{$user->email}} </div>
                      <div class="form-group"> <label for="Message">Phone:</label>  <div class="form-control">{{$user->phone}} </div>
                      <div class="form-group"> <label for="Message">Company Name:</label>  <div class="form-control">{{$user->compnay_name}} </div> 
                     <form method="post" action="{{ url('/updatewriter/')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="hidden" name="id" value="{{$user->id}}" />
                              <div class="form-group">
                            <label for="status">Status:</label>    
                           <select name="status"  class="form-control" >
                             <option value="0" <?php if($user->status == 0){ echo 'selected="selected"'; } ?>>Approved</option>
                             <option value="1"  <?php if($user->status == 1){ echo 'selected="selected"'; } ?>>Unapproved</option>
                           </select>
                           </div>
                           <input type="submit" name="update"  class="btn btn-default"  value="Update" />
                     </form>
                    </div>
                    
                    
                    <!-- /.box-body -->

                    
                </div>
            </div>
        </div>
    </div>
@stop
