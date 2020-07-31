
<style>
/* .custom-progress-bar ul li {
    list-style: none;
    padding: 10px 35px;
    display: inline-block;
    max-width: 266px;
    width: 100%;
}
.custom-progress-bar ul li::after {
    content: "";
    width: 242px;
    border: 2px solid #6A9134;
    height: 2px;
    background: #6A9134;
    float: left;
    position: absolute;
    top: 46px;
}
.custom-progress-bar ul li span {
    width: 15px;
    height: 15px;
    background: #f8f8f8;
    border: 1px solid #ddd;
    border-radius: 50px;
    float: left;
    position: relative;
    margin-right: 6px;
}
.custom-progress-bar ul li:last-child::after{display:none;}
.custom-progress-bar ul .active span {
    background: #6A9134;
}
.custom-progress-bar ul li::after{background: #f8f8f8;
    border: 1px solid #ddd;}
 .custom-progress-bar ul li.active::after{background: #6A9134;
    border: 1px solid #6A9134;}
    .progres-text li {
    display: inline-block;
    list-style: none;
    padding: 0px 35px;
    display: inline-block;
    max-width: 266px;
    width: 100%;
}
ul.progres-text {
    clear: both;
    float: none;
    width: 100%;
}
.progres-text li {
    display: inline-block;
    list-style: none;
    font-weight: 600;
    padding: 0px 35px;
    display: inline-block;
    max-width: 237px;
    width: 100%;
    font-size: 16px;
} */
</style>

<?php //print_r($job_details); ?>
@extends('dashboard.master')

@section('content-header')
    <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    </ol>
@stop


@section('content')
  <div class="row">
         
        <div class="col-md-12">
             <ul class="progres-text">
    <li>Order Started</li>
    <li>Order Uploaded</li>
      <li>Final Draft Approved</li>
    </ul>
<div class="custom-progress-bar">  
   <ul> 
 
    <li class="<?php if($job_details->status_type == 'order_accepted' || $job_details->status_type == 'writing'  || $job_details->status_type == 'draft_ready' || $job_details->status_type == 'Assigned'|| $job_details->status_type == 'writing' || $job_details->status_type == 'final_ready' || $job_details->status_type == 'revision' ){ echo 'active'; } ?>"><span></span></li>
    <li class="<?php if($job_details->status_type == 'order_accepted' || $job_details->status_type == 'draft_ready' || $job_details->status_type == 'final_ready' || $job_details->status_type == 'revision'){ echo 'active'; } ?>"><span></span></li>
    <li class="<?php if($job_details->status_type == 'order_accepted'){ echo 'active'; } ?>"> <span></span></li>
    
    </ul>
</div>
</div>
</div>

    <div class="row">
         
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> Job Details</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="">
                        <div class="">
                            <div class="row job-detail-list">
                                <div class="col-md-12">
                                    <h4 style="color: cornflowerblue"><u>Order Name</u> : {{ $job_details->order->packages->title or 'N/A' }}</h4>
                                </div>

                                <div class="col-md-12">
                                    <p><u>Order Ref. No.</u> : {{ $job_details->id or 'N/A' }}</p>
                                     
                                </div>


                                <div class="col-md-12">
                                    @if(count($job_details->client))
                                        <?php
                                            $full_n = $job_details->client->name;
                                            $names = explode(' ', $full_n);
                                            $first = array_shift($names);
                                            $last = array_pop($names);
                                        ?>
                                        <p>
                                            <u>Client Name</u> : {!! $first or '' !!} @if(count($last)){!! $last[0] or '' !!}@endif
                                            @if(count($last)) @if($last[0] != null) . @endif @endif
                                        </p>

                                    @else

                                        <p>
                                            <u>Client Name</u> : <strong style="color: darkred">User Deleted/Not Available </strong>
                                        </p>

                                    @endif
                                     
                                </div>


                                <div class="col-md-12">
                                    @if(count($job_details->writer))
                                        <?php
                                            $full_n = $job_details->writer->name;
                                            $names = explode(' ', $full_n);
                                            $first = array_shift($names);
                                            $last = array_pop($names);
                                        ?>
                                        <p>
                                            <u>Writer Name</u> : {!! $first or '' !!} @if(count($last)){!! $last[0] or '' !!}@endif
                                            @if(count($last)) @if($last[0] != null) . @endif @endif
                                        </p>
                                    @else
                                        <p>
                                            <u>Writer Name</u> : <strong style="color: darkred">User Deleted/Not Available</strong>
                                        </p>
                                    @endif
                                     
                                </div>


                                <div class="col-md-12">
                                    <p style="color: darkgreen"><u>Status Type</u> : {{ ucfirst(str_replace('_', ' ',strtolower($job_details->status_type))) }}</p>
                                     
                                </div>

                                <div class="col-md-12">
                                    <p><u>Description</u> : {{ $order_details->order_details or 'N/A' }}</p>
                                     
                                </div>
                                
                                 @if($job_details->status_type == 'Assigned')
                                  <div class="col-md-12">
                                    <p><u>Title</u> : {{ $order_details->topic or 'N/A' }}</p>
                                     
                                  </div>
                                  <div class="col-md-12">
                                        <p><u>Word Count</u> : {{ $order_details->total_words or 'N/A' }}</p>
                                         
                                   </div>
                                   <div class="col-md-12">
                                        <p><u>Quantity</u> : {{ $order_details->quantity or 'N/A' }}</p>
                                         
                                   </div>
                                    @if($order_details->attachment != '')
                                   <div class="col-md-12">
                                   <?php $array = explode('/',$order_details->attachment); $key = count($array)-1;  ?>
                                        <p><u>Attachment</u> : <a href="{{ url($order_details->attachment)}}" download><?php echo $array[$key]; ?></a></p>
                                         
                                   </div>
                                      @endif
                                @endif

                                <div class="col-md-12">
                                    <p><u>Submission Date</u> : {{ $job_details->submission_date or 'N/A' }}</p>
                                     
                                </div>                               
                              
                              <!--  <div class="col-md-12">
                                    <p><u>Paid Amount</u> : ${{ number_format((float)$job_details->order->paid_amount, 2, '.', '') or 'N/A' }}</p>
                                     
                                </div>-->

                                {{--<div class="col-md-12">--}}
                                    {{--<p><u>Remaining Amount</u> : ${{ number_format((float)$job_details->order->remaining_payment_amount, 2, '.', '') }}</p>--}}
                                    {{--<br>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>

        <div class="row">
            <div class="col-md-7">
                <!-- Chat box -->
            <!--   {!! Form::model($job_details,['method'=>'PUT','route'=>['assignedJobs.update',$job_details->id], 'class' =>'form col-md-12','id'=>'job-form', 'enctype'=>'multipart/form-data']) !!} -->
 <form class="form-horizontal" role="form" method="POST" action="{{ url('/assignedJobs/updateChat') }}" enctype="multipart/form-data">
               {!! csrf_field() !!}

                <div class="box box-success">
                    <div class="box-header">
                        <i class="fa fa-comments-o"></i>
                        <h3 class="box-title">Chat</h3>
                        {{--<div class="box-tools pull-right" data-toggle="tooltip" title="Status">--}}
                            {{--<div class="btn-group" data-toggle="btn-toggle" >--}}
                                {{--<button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button>--}}
                                {{--<button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>

                    <div class="box-body chat" id="chat-box">
                        <!-- chat item -->
                        <div class="item">
                            @if(isset($user->profile->photo))
                                {!! HTML::image(user_photo_path().$user->profile->photo, $user->name, ['class' =>'img-circle img-responsive', 'height' => '160', 'width' => '160', 'alt' => 'User profile picture']) !!}
                            @else
                                <img src="" alt="" class="">
                            @endif

                            <p class="message">
                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{ date('Y-m-d') }}</small>
                                <label class="name col-md-4"> 
                                    {!! Form::text('from_user', Auth::id(),['class'=>'form-control hidden', 'readonly']) !!}

                                    @if(count($job_details->client) && count($job_details->writer))
                                        @if($job_details->client->id == Auth::id())
                                            {!! Form::text('to_user', $job_details->writer->id,['class'=>'form-control hidden', 'readonly']) !!}
                                        @elseif($job_details->writer->id == Auth::id())
                                            {!! Form::text('to_user', $job_details->client->id,['class'=>'form-control hidden', 'readonly']) !!}
                                        @endif
                                    @endif                                     

                                    @if(count($job_details->writer) && count($job_details->client))
                                        @if($job_details->writer->id == Auth::id())
                                            {{ $job_details->writer->name }}
                                        @elseif($job_details->client->id == Auth::id())
                                            {{ $job_details->client->name }}
                                        @endif
                                    @endif

                                </label>

                                {!! Form::textarea('body', null,['class'=>'form-control','rows'=>'2', 'placeholder'=>'Type message...']) !!}
                            </p>
                        </div><!-- /.item -->


                    {!! Form::number('order_id', $job_details->order->id,['class'=>'form-control hidden', 'readonly']) !!}

                        @if(count($job_details->writer) && count($job_details->client))
                            <div class="">
                                {{ Form::file('attachment', ['class'=>'attachment pull-left']) }}
                                {{ Form::submit('Send', ['class'=>'btn btn-success pull-right blue-main-btn']) }}
                            </div>
                        @else
                            <div class="">
                                {{ Form::file('attachment', ['class'=>'attachment pull-left', 'disabled'=>'disabled']) }}
                                {{ Form::submit('Send', ['class'=>'btn btn-success pull-right blue-main-btn', 'disabled'=>'disabled']) }}
                            </div>
                        @endif

                    </div><!-- /.chat -->

                    {{--<div class="box-footer">--}}
                        {{--<div class="input-group">--}}
                            {{--<input class="form-control" name="body" placeholder="Type message...">--}}
                            {{--<div class="input-group-btn">--}}
                                {{--<button class="btn btn-success"><i class="fa fa-plus"></i></button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="box-body" style="overflow-x: scroll; height: 200px">
                        <table id="example2" class="table table-bordered table-striped table-hover">
                            @foreach($message_info as $info)
                                <tr>
                                    @if(count($info->message_sender))
                                        <?php
                                            $full_n = $info->message_sender->name;
                                            $names = explode(' ', $full_n);
                                            $first = array_shift($names);
                                            $last = array_pop($names);
                                        ?>

                                        @if($info->from_user == Auth::id())
                                            <td bgcolor="#8a8a5c">{!! $first or '' !!} {!! $last[0] or '' !!}
                                                @if($last[0] != null)
                                                    .
                                                @endif
                                            </td>
                                        @else
                                            <td bgcolor="#29a3a3">{!! $first or '' !!} {!! $last[0] or '' !!}
                                                @if($last[0] != null)
                                                    .
                                                @endif
                                            </td>
                                        @endif
 
                                    @else

                                        @if($info->from_user == Auth::id())
                                            <td bgcolor="#8a8a5c">
                                                --
                                            </td>
                                        @else
                                            <td bgcolor="#29a3a3">
                                                --
                                            </td>
                                        @endif

                                    @endif


                                    <td>
                                        {!! $info->body !!}

                                        @if($info->attachment != null)
                                            @if(isset($info->attachment))
                                                 
                                                <a class="btn-primary" href="{{ URL::to('/'.$info->attachment) }}"> <i class="fa fa-download"></i> Download Attachment</a>
                                            @endif
                                        @endif
                                    </td>
                                    <td><p style="color: darkgreen">{!! $info->updated_at->addHours(6) !!}  ({!! $info->updated_at->diffForHumans() !!})</p></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div><!-- /.box (chat box) -->
            </form>
            </div>


            <div class="col-md-5">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> Setting</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="">
                            {{--{!! Form::model($job_details,['method'=>'PUT','route'=>['assignedJobs.update',$job_details->id], 'class' =>'form col-md-12']) !!}--}}
                          
              {!! Form::model($job_details,['method'=>'PUT','route'=>['assignedJobs.update',$job_details->id], 'class' =>'form col-md-12','id'=>'job-form', 'enctype'=>'multipart/form-data']) !!}
                            <div class="">
                                <div class="row">
                                    <div class="box-header paddinglr-0">
                                        <label class="control-label col-md-4"> Set Description:</label>
                                        <div class="col-md-8">

                                            @if(count($job_details->writer) && count($job_details->client))
                                                {!! Form::textarea('description', null,['class'=>'form-control description','rows'=>'3', 'placeholder'=>'Description', 'id'=>'description']) !!}
                                            @else
                                                {!! Form::textarea('description', null,['class'=>'form-control description','rows'=>'3', 'placeholder'=>'Description', 'id'=>'description', 'readonly']) !!}
                                            @endif

                                        </div>
                                    </div>

                                    <div class="">
                                        <label class="control-label col-md-4"> Job Status:</label>
                                        <div class="col-md-8">
                                            @if(count($job_details->writer) && count($job_details->client))
                                                <select class="form-control job-status" name="status_type">
                                                    <option value="{{ $job_details->status_type }}">{{ ucfirst(str_replace('_', ' ',strtolower($job_details->status_type))) }}</option>
                                                    {{--<option value="{{ $job_details->status_type }}">{{ ucfirst(str_replace('_', ' ',strtolower($job_details->status_type))) }}</option>--}}
                                                    {{--<option value="screening">Screening</option>--}}
                                                    @can('writer.access')
                                                        <option value="writing">Writing</option>
                                                        <option value="draft_ready">Draft Ready</option>
                                                        <option value="final_ready">Final Ready</option>
                                                    @endcan

                                                    <option value="revision">Revision</option>

                                                    @can('client.access')
                                                        <option value="order_accepted">Order Accepted</option>
                                                    @endcan

                                                    <option value="unassigned">Unassigned</option>
                                                </select>
                                            @else

                                                <input class="form-control job-status" type="text" name="status_type" value="{{ $job_details->status_type }}" readonly>

                                            @endif
                                             
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="">
                                @if(count($job_details->writer) && count($job_details->client))
                                    {!! Form::submit('Submit', ['class'=>'btn btn-success pull-right margint-20 blue-main-btn']) !!}
                                @else
                                    {!! Form::submit('Submit', ['class'=>'btn btn-success pull-right margint-20 blue-main-btn', 'disabled'=>'disabled']) !!}
                                @endif
                            </div>

                        {!! Form::close() !!}

                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                  @can('client.access')
                         <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Submit your Rating</h3>
                            </div>
                    <!-- /.box-header -->
                       <div class="box-body">
                           <form class="form-horizontal" role="form" method="POST" action="{{ url('/assignedJobs/updateReview') }}">
                        {!! csrf_field() !!}

                             <div class="">
                                <div class="row">
                                 <input type="hidden" name="clientId" value="<?php echo $job_details->client_id;?>"/>
                                 <input type="hidden" name="writterId" value="<?php echo $job_details->writer_id;?>"/>
                                 <input type="hidden" name="orderId" value="<?php echo $job_details->order_id;?>"/>

                                <div class="box-header paddinglr-0 rating-starz">
                                        <label class="control-label col-md-4"> Rating</label>
                                        <div class="col-md-8">
                                          <?php
                                          for($i=1; $i <= 5; $i++){
                                            echo '<input class="rating-star" type="radio" name="rating" id="rating'.$i.'" value="'.$i.'">
                                              <label for ="rating'.$i.'"></label>';
                                          }
                                          ?>

                                        </div>
                                    </div>
                                    <div class="box-header paddinglr-0">
                                        <label class="control-label col-md-4"></label>
                                        <div class="col-md-8">
                                                <input class="blue-main-btn color-whit" type="submit" value="Submit" name="savereviews" />
                                        </div>
                                    </div>
                            </div>
                        </div>
                         </form>
                       </div>
                   </div>
                  @endcan
            </div>
        </div>
        </div>
    </div>
@stop

@section('scripts')

    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>--}}
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>--}}
<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery('.rating-star').click(function(){
        var val = jQuery(this).val(); 
        var i= 1; 
        jQuery('.rating-starz').find('.rating-star').each(function(){
              if(i <= val){ jQuery(this).addClass('active'); }
              else{  jQuery(this).removeClass('active'); } 
              i = i + 1;
          });
       });
})
</script>
@endsection

<style>
.rating-starz input[type="radio"] {

    width: 0px;
    height: 0px;
    margin: 0px;
    padding: 0px;
    overflow: hidden;
    position: relative;
    opacity: 0;

}

.rating-starz input[type="radio"] + label{

    background: none;
    width: 10px;
    height: 10px;
   /* margin-left: -14px; */
    margin-right: 10px;
    margin-top: 5px;
    position: relative;
    z-index: 1;

}
.rating-starz input[type="radio"] + label::after {

    content: "\f006";
    font-family: fontawesome;
    color: #777;
    font-size: 18px;

}
.rating-starz input[type="radio"]:checked + label::after , .rating-starz input.active + label::after {

    content: "\f005";
    color: #003b97;

}
.color-whit{
    color:#fff;
}
</style>

